<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectMilestone;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() { return view('projects.index', ['projects' => Project::with('client')->latest()->paginate(20)]); }
    public function create() { return view('projects.create'); }
    public function store(Request $request) { return redirect()->route('projects.index'); }
    public function show(Project $project) { return view('projects.show', compact('project')); }
    public function update(Request $request, Project $project) { return redirect()->route('projects.show', $project); }
    public function destroy(Project $project) { return redirect()->route('projects.index'); }
    public function addMilestone(Request $request, Project $project) { return back(); }
    public function updateMilestone(Request $request, ProjectMilestone $milestone) { return back(); }
    public function assignContractor(Request $request, Project $project) { return back(); }
    public function logSiteVisit(Request $request, Project $project) { return back(); }
    public function timeline(Project $project) { return view('projects.show', compact('project')); }
}
