<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectMilestone extends Model
{
    protected $fillable = ['project_id','title','description','due_date','completed_date','status','sort_order'];
    protected $casts = ['due_date' => 'date', 'completed_date' => 'date'];

    public function project() { return $this->belongsTo(Project::class); }
}
