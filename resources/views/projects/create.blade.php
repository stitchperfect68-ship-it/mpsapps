@extends('layouts.app')
@section('title', 'New Project')
@section('content')
<div class="page-header"><h1 class="page-title">New Project</h1></div>
<div class="page-body"><div class="card coming-soon"><div class="icon">🚧</div><h2>Project Form</h2><p>Coming soon.</p><a href="{{ route('projects.index') }}" class="btn-outline" style="margin-top:20px;">← Back</a></div></div>
@endsection
