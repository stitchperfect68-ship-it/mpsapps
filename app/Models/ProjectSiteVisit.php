<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectSiteVisit extends Model
{
    protected $fillable = ['project_id','user_id','visit_date','observations','photos','status'];
    protected $casts = ['visit_date' => 'date', 'photos' => 'array'];

    public function project() { return $this->belongsTo(Project::class); }
    public function user() { return $this->belongsTo(User::class); }
}
