@extends('layouts.app')
@section('title', 'Projects')
@section('content')
<div class="page-header">
    <div class="page-header-inner">
        <div><div style="font-size:10px;letter-spacing:0.2em;text-transform:uppercase;color:rgba(201,168,76,0.5);margin-bottom:6px;">Module 05</div><h1 class="page-title">📐 Project Management</h1></div>
        <a href="{{ route('projects.create') }}" class="btn-gold">+ New Project</a>
    </div>
</div>
<div class="page-body">
    <div class="card">
        <table>
            <thead><tr><th>Project</th><th>Client</th><th>Type</th><th>Status</th><th>Completion</th><th>End Date</th></tr></thead>
            <tbody>
            @forelse($projects as $project)
                <tr>
                    <td><a href="{{ route('projects.show', $project) }}" style="color:#C9A84C;">{{ $project->project_number }}</a><br><span style="font-size:11px;color:rgba(245,240,232,0.4);">{{ $project->name }}</span></td>
                    <td>{{ $project->client?->name }}</td>
                    <td>{{ ucfirst($project->type) }}</td>
                    <td><span class="badge" style="background:rgba(234,179,8,0.12);color:#EAB308;">{{ ucfirst($project->status) }}</span></td>
                    <td>{{ $project->completion_percent }}%</td>
                    <td>{{ $project->end_date?->format('d M Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align:center;padding:40px;color:rgba(245,240,232,0.3);">No projects yet</td></tr>
            @endforelse
            </tbody>
        </table>
        <div style="padding:16px 20px;">{{ $projects->links() }}</div>
    </div>
</div>
@endsection
