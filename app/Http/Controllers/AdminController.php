<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index() { return view('admin.index'); }

    // ── Users list ────────────────────────────────────────────────
    public function users()
    {
        return view('admin.users', [
            'users' => User::with('role')->latest()->paginate(20),
        ]);
    }

    // ── Create user form ──────────────────────────────────────────
    public function createUser()
    {
        return view('admin.create-user', ['roles' => Role::orderBy('display_name')->get()]);
    }

    public function storeUser(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name'  => ['required', 'string', 'max:100'],
            'email'      => ['required', 'email', 'unique:users,email'],
            'role_id'    => ['required', 'exists:roles,id'],
            'department' => ['nullable', 'string', 'max:100'],
            'phone'      => ['nullable', 'string', 'max:30'],
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
            'is_active'  => ['nullable', 'boolean'],
        ]);

        $data['password']          = Hash::make($data['password']);
        $data['is_active']         = $request->boolean('is_active', true);
        $data['email_verified_at'] = now();

        User::create($data);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    // ── Edit user form ────────────────────────────────────────────
    public function editUser(User $user)
    {
        return view('admin.edit-user', [
            'user'  => $user->load('role'),
            'roles' => Role::orderBy('display_name')->get(),
        ]);
    }

    public function updateUser(Request $request, User $user)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name'  => ['required', 'string', 'max:100'],
            'email'      => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'role_id'    => ['required', 'exists:roles,id'],
            'department' => ['nullable', 'string', 'max:100'],
            'phone'      => ['nullable', 'string', 'max:30'],
            'is_active'  => ['nullable', 'boolean'],
            'password'   => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $data['is_active'] = $request->boolean('is_active', false);

        $user->update($data);

        return redirect()->route('admin.users')->with('success', "User {$user->first_name} {$user->last_name} updated.");
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User removed.');
    }

    // ── Roles ─────────────────────────────────────────────────────
    public function roles() { return view('admin.index', ['roles' => Role::all()]); }
    public function storeRole(Request $request) { return redirect()->route('admin.roles'); }
    public function updatePermissions(Request $request, Role $role) { return redirect()->route('admin.roles'); }

    // ── Other ─────────────────────────────────────────────────────
    public function auditLogs() { return view('admin.index', ['logs' => AuditLog::latest('created_at')->paginate(50)]); }
    public function systemSettings() { return view('admin.index'); }
    public function updateSystemSettings(Request $request) { return redirect()->route('admin.system'); }
    public function databaseStatus() { return view('admin.index'); }
    public function createBackup() { return back(); }
}
