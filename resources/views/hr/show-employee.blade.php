@extends('layouts.app')
@section('title', 'Employee')
@section('content')
<div class="page-header"><h1 class="page-title">{{ $employee->name }}</h1></div>
<div class="page-body"><div class="card coming-soon"><div class="icon">👤</div><h2>Employee Profile</h2><p>Full employee view coming soon.</p><a href="{{ route('hr.employees') }}" class="btn-outline" style="margin-top:20px;">← Back</a></div></div>
@endsection
