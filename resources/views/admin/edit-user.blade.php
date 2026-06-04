@extends('layouts.app')
@section('title', 'Edit User')
@section('content')

<div class="page-header">
    <div class="page-header-inner">
        <div>
            <div class="page-subtitle">Users / Edit</div>
            <h1 class="page-title">{{ $user->first_name }} {{ $user->last_name }}</h1>
        </div>
        <a href="{{ route('admin.users') }}" class="btn-outline">← Back to Users</a>
    </div>
</div>

<div class="page-body">
    <div style="max-width:680px;">

        @if($errors->any())
            <div class="alert alert-error">
                <strong>Please fix the following:</strong>
                <ul style="margin:6px 0 0 16px;">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf @method('PUT')

            {{-- ── Identity ──────────────────────────────────────── --}}
            <div class="card" style="padding:24px;margin-bottom:16px;">
                <div style="font-size:11px;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--text-muted);margin-bottom:20px;">Identity</div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="form-group" style="margin:0;">
                        <label class="form-label">First Name *</label>
                        <input type="text" name="first_name" class="form-input"
                               value="{{ old('first_name', $user->first_name) }}" required autofocus>
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label class="form-label">Last Name *</label>
                        <input type="text" name="last_name" class="form-input"
                               value="{{ old('last_name', $user->last_name) }}" required>
                    </div>
                </div>

                <div class="form-group" style="margin-top:16px;margin-bottom:0;">
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email" class="form-input"
                           value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group" style="margin-top:16px;margin-bottom:0;">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-input"
                           placeholder="+260 97X XXX XXX"
                           value="{{ old('phone', $user->phone) }}">
                </div>
            </div>

            {{-- ── Role & Department ─────────────────────────────── --}}
            <div class="card" style="padding:24px;margin-bottom:16px;">
                <div style="font-size:11px;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--text-muted);margin-bottom:20px;">Role & Department</div>

                <div class="form-group" style="margin-bottom:16px;">
                    <label class="form-label">Role *</label>
                    <select name="role_id" class="form-input" required>
                        <option value="">— Select role —</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                {{ $role->display_name }}
                                ({{ implode(', ', array_map(fn($p) => str_replace('access-','',$p), $role->permissions ?? [])) }})
                            </option>
                        @endforeach
                    </select>
                    <div style="font-size:11px;color:var(--text-light);margin-top:5px;">
                        Controls which modules this user can access after login.
                    </div>
                </div>

                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Department</label>
                    <input type="text" name="department" class="form-input"
                           placeholder="e.g. Production, Sales, Finance…"
                           value="{{ old('department', $user->department) }}">
                </div>
            </div>

            {{-- ── Account status ────────────────────────────────── --}}
            <div class="card" style="padding:24px;margin-bottom:16px;">
                <div style="font-size:11px;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--text-muted);margin-bottom:20px;">Account Status</div>

                <label style="display:flex;align-items:center;gap:12px;cursor:pointer;">
                    <div style="position:relative;width:44px;height:24px;flex-shrink:0;">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" id="is_active"
                               {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                               style="opacity:0;width:0;height:0;position:absolute;"
                               onchange="document.getElementById('toggleBg').style.background=this.checked?'var(--success)':'var(--border)'">
                        <div id="toggleBg" onclick="document.getElementById('is_active').click()"
                             style="position:absolute;inset:0;border-radius:12px;cursor:pointer;transition:background 0.2s;background:{{ old('is_active', $user->is_active) ? 'var(--success)' : 'var(--border)' }};">
                            <div id="toggleThumb"
                                 style="position:absolute;top:3px;left:{{ old('is_active', $user->is_active) ? '23px' : '3px' }};width:18px;height:18px;background:#fff;border-radius:50%;transition:left 0.2s;box-shadow:0 1px 3px rgba(0,0,0,0.2);">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div style="font-size:13px;font-weight:500;color:var(--navy);">Account Active</div>
                        <div style="font-size:11px;color:var(--text-muted);">Inactive users cannot sign in.</div>
                    </div>
                </label>
            </div>

            {{-- ── Reset password (optional) ─────────────────────── --}}
            <div class="card" style="padding:24px;margin-bottom:24px;">
                <div style="font-size:11px;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--text-muted);margin-bottom:6px;">Reset Password</div>
                <div style="font-size:12px;color:var(--text-muted);margin-bottom:16px;">Leave blank to keep the current password.</div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="form-group" style="margin:0;">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" class="form-input"
                               placeholder="Min. 8 characters" autocomplete="new-password">
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-input"
                               placeholder="Repeat password">
                    </div>
                </div>
            </div>

            {{-- ── Submit ────────────────────────────────────────── --}}
            <div style="display:flex;gap:12px;align-items:center;">
                <button type="submit" class="btn-navy" style="padding:11px 28px;font-size:14px;">
                    Save Changes
                </button>
                <a href="{{ route('admin.users') }}" class="btn-outline">Cancel</a>

                <div style="margin-left:auto;font-size:11px;color:var(--text-light);">
                    Created {{ $user->created_at->format('d M Y') }}
                    &middot; Last login {{ $user->last_login_at?->diffForHumans() ?? 'never' }}
                </div>
            </div>

        </form>
    </div>
</div>

<script>
// Sync toggle thumb position when checkbox changes
document.getElementById('is_active').addEventListener('change', function() {
    document.getElementById('toggleThumb').style.left = this.checked ? '23px' : '3px';
});
</script>

@endsection
