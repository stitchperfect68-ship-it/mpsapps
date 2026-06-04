@extends('layouts.app')
@section('title', 'New User')
@section('content')

<div class="page-header">
    <div class="page-header-inner">
        <div>
            <div class="page-subtitle">Users / New</div>
            <h1 class="page-title">Create User</h1>
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

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            {{-- ── Identity ──────────────────────────────────────── --}}
            <div class="card" style="padding:24px;margin-bottom:16px;">
                <div style="font-size:11px;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--text-muted);margin-bottom:20px;">Identity</div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="form-group" style="margin:0;">
                        <label class="form-label">First Name *</label>
                        <input type="text" name="first_name" class="form-input"
                               value="{{ old('first_name') }}" required autofocus>
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label class="form-label">Last Name *</label>
                        <input type="text" name="last_name" class="form-input"
                               value="{{ old('last_name') }}" required>
                    </div>
                </div>

                <div class="form-group" style="margin-top:16px;margin-bottom:0;">
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email" class="form-input"
                           placeholder="name@myperfectstitch.co.zm"
                           value="{{ old('email') }}" required>
                </div>

                <div class="form-group" style="margin-top:16px;margin-bottom:0;">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-input"
                           placeholder="+260 97X XXX XXX"
                           value="{{ old('phone') }}">
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
                                {{ old('role_id') == $role->id ? 'selected' : '' }}>
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
                           value="{{ old('department') }}">
                </div>
            </div>

            {{-- ── Password ──────────────────────────────────────── --}}
            <div class="card" style="padding:24px;margin-bottom:24px;">
                <div style="font-size:11px;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--text-muted);margin-bottom:20px;">Password</div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="form-group" style="margin:0;">
                        <label class="form-label">Password *</label>
                        <input type="password" name="password" class="form-input"
                               placeholder="Min. 8 characters" required autocomplete="new-password">
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label class="form-label">Confirm Password *</label>
                        <input type="password" name="password_confirmation" class="form-input"
                               placeholder="Repeat password" required>
                    </div>
                </div>
            </div>

            {{-- ── Submit ────────────────────────────────────────── --}}
            <div style="display:flex;gap:12px;align-items:center;">
                <button type="submit" class="btn-gold" style="padding:11px 28px;font-size:14px;">
                    Create User
                </button>
                <a href="{{ route('admin.users') }}" class="btn-outline">Cancel</a>
            </div>

        </form>
    </div>
</div>

@endsection
