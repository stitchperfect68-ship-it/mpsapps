@extends('layouts.app')
@section('title', 'Project')
@section('content')
<div class="page-header"><h1 class="page-title">{{ $project->name }}</h1></div>
<div class="page-body"><div class="card coming-soon"><div class="icon">📐</div><h2>Project Detail</h2><p>Full project view coming soon.</p><a href="{{ route('projects.index') }}" class="btn-outline" style="margin-top:20px;">← Back</a></div></div>
@endsection
