@extends('layouts.app')
@section('title', 'Super Admin')
@section('content')
<div class="page-header"><div style="font-size:10px;letter-spacing:0.2em;text-transform:uppercase;color:rgba(201,168,76,0.5);margin-bottom:6px;">Module 11</div><h1 class="page-title">🔐 Super Admin</h1></div>
<div class="page-body">
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;">
    <a href="{{ route('admin.users') }}" class="card" style="padding:20px;text-decoration:none;display:block;"><div style="font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:rgba(201,168,76,0.5);">Users</div><div style="font-size:24px;margin-top:8px;">👥</div></a>
    <a href="{{ route('admin.roles') }}" class="card" style="padding:20px;text-decoration:none;display:block;"><div style="font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:rgba(201,168,76,0.5);">Roles</div><div style="font-size:24px;margin-top:8px;">🛡️</div></a>
    <a href="{{ route('admin.audit-logs') }}" class="card" style="padding:20px;text-decoration:none;display:block;"><div style="font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:rgba(201,168,76,0.5);">Audit Logs</div><div style="font-size:24px;margin-top:8px;">📋</div></a>
    <a href="{{ route('admin.system') }}" class="card" style="padding:20px;text-decoration:none;display:block;"><div style="font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:rgba(201,168,76,0.5);">System</div><div style="font-size:24px;margin-top:8px;">⚙️</div></a>
</div>
</div>
@endsection
