@extends('layouts.app')
@section('title', 'Employees')
@section('content')
<div class="page-header">
    <div class="page-header-inner"><h1 class="page-title">👔 Employees</h1><a href="{{ route('hr.employees.create') }}" class="btn-gold">+ Add Employee</a></div>
</div>
<div class="page-body">
<div class="card">
<table>
<thead><tr><th>Employee #</th><th>Name</th><th>Department</th><th>Job Title</th><th>Status</th></tr></thead>
<tbody>
@forelse($employees as $emp)
<tr>
<td style="color:rgba(245,240,232,0.4);font-size:11px;">{{ $emp->employee_number }}</td>
<td><a href="{{ route('hr.employees.show', $emp) }}" style="color:#C9A84C;">{{ $emp->name }}</a></td>
<td>{{ $emp->department?->name }}</td>
<td style="color:rgba(245,240,232,0.6);">{{ $emp->job_title }}</td>
<td><span class="badge" style="background:rgba(34,197,94,0.1);color:#22c55e;">{{ ucfirst($emp->status) }}</span></td>
</tr>
@empty
<tr><td colspan="5" style="text-align:center;padding:40px;color:rgba(245,240,232,0.3);">No employees yet</td></tr>
@endforelse
</tbody>
</table>
<div style="padding:16px 20px;">{{ $employees->links() }}</div>
</div>
</div>
@endsection
