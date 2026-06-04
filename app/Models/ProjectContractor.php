<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectContractor extends Model
{
    protected $fillable = ['project_id','name','company','trade','phone','contract_value'];

    public function project() { return $this->belongsTo(Project::class); }
}
