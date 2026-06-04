<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'project_number','client_id','manager_id','name','description','location',
        'type','status','budget','actual_cost','start_date','end_date','completion_percent',
    ];

    protected $casts = ['start_date' => 'date', 'end_date' => 'date'];

    public function client() { return $this->belongsTo(Client::class); }
    public function manager() { return $this->belongsTo(User::class, 'manager_id'); }
    public function milestones() { return $this->hasMany(ProjectMilestone::class); }
    public function contractors() { return $this->hasMany(ProjectContractor::class); }
    public function siteVisits() { return $this->hasMany(ProjectSiteVisit::class); }
}
