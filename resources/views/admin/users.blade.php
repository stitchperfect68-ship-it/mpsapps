@extends('layouts.app')
@section('title', 'Users')
@section('content')

<div class="page-header">
    <div class="page-header-inner">
        <div>
            <div class="page-subtitle">Super Admin</div>
            <h1 class="page-title">Users</h1>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn-gold">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            New User
        </a>
    </div>
</div>

<div class="page-body">

    @if(session('success'))
        <div class="alert alert-success" style="margin-bottom:16px;">{{ session('success') }}</div>
    @endif

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Last Login</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:34px;height:34px;border-radius:50%;background:var(--navy);color:#fff;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:600;flex-shrink:0;">
                                {{ strtoupper(substr($user->first_name,0,1).substr($user->last_name,0,1)) }}
                            </div>
                            <div>
                                <div style="font-weight:600;color:var(--navy);">{{ $user->first_name }} {{ $user->last_name }}</div>
                                <div style="font-size:11px;color:var(--text-muted);">ID #{{ $user->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="color:var(--text-muted);">{{ $user->email }}</td>
                    <td style="color:var(--text-muted);">{{ $user->department ?? '—' }}</td>
                    <td>
                        <span class="badge" style="background:rgba(16,7,54,0.08);color:var(--navy);">
                            {{ $user->role?->display_name ?? '—' }}
                        </span>
                    </td>
                    <td>
                        @if($user->is_active)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-error">Inactive</span>
                        @endif
                    </td>
                    <td style="color:var(--text-light);font-size:12px;">
                        {{ $user->last_login_at?->diffForHumans() ?? 'Never' }}
                    </td>
                    <td>
                        <div style="display:flex;align-items:center;justify-content:flex-end;gap:8px;">
                            <a href="{{ route('admin.users.edit', $user) }}"
                               style="display:inline-flex;align-items:center;gap:5px;font-size:12px;font-weight:500;color:var(--navy);text-decoration:none;padding:5px 12px;border:1.5px solid var(--border);border-radius:6px;transition:all 0.18s;"
                               onmouseover="this.style.borderColor='var(--navy)'"
                               onmouseout="this.style.borderColor='var(--border)'">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit
                            </a>
                            @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                  onsubmit="return confirm('Remove {{ $user->first_name }} {{ $user->last_name }}? This cannot be undone.')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    style="display:inline-flex;align-items:center;gap:5px;font-size:12px;font-weight:500;color:var(--error);background:none;border:1.5px solid var(--border);border-radius:6px;padding:5px 12px;cursor:pointer;transition:all 0.18s;font-family:'Poppins',sans-serif;"
                                    onmouseover="this.style.borderColor='var(--error)';this.style.background='var(--error-bg)'"
                                    onmouseout="this.style.borderColor='var(--border)';this.style.background='none'">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Remove
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:48px;color:var(--text-muted);">
                        No users found.
                        <a href="{{ route('admin.users.create') }}" style="color:var(--navy);font-weight:500;">Create one →</a>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        @if($users->hasPages())
            <div style="padding:14px 20px;border-top:1px solid var(--border);">{{ $users->links() }}</div>
        @endif
    </div>
</div>

@endsection
