@extends('layouts.app')
@section('title', 'HR & Payroll')
@section('content')
<div class="page-header"><div style="font-size:10px;letter-spacing:0.2em;text-transform:uppercase;color:rgba(201,168,76,0.5);margin-bottom:6px;">Module 08</div><h1 class="page-title">👔 HR & Payroll</h1></div>
<div class="page-body">
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;">
    <a href="{{ route('hr.employees') }}" class="card" style="padding:20px;text-decoration:none;display:block;"><div style="font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:rgba(201,168,76,0.5);">Employees</div><div style="font-size:24px;margin-top:8px;">👤</div></a>
    <a href="{{ route('hr.attendance') }}" class="card" style="padding:20px;text-decoration:none;display:block;"><div style="font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:rgba(201,168,76,0.5);">Attendance</div><div style="font-size:24px;margin-top:8px;">🕐</div></a>
    <a href="{{ route('hr.leave') }}" class="card" style="padding:20px;text-decoration:none;display:block;"><div style="font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:rgba(201,168,76,0.5);">Leave</div><div style="font-size:24px;margin-top:8px;">🌴</div></a>
    <a href="{{ route('hr.payroll') }}" class="card" style="padding:20px;text-decoration:none;display:block;"><div style="font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:rgba(201,168,76,0.5);">Payroll</div><div style="font-size:24px;margin-top:8px;">💵</div></a>
</div>
</div>
@endsection
