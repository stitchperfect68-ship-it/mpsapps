<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name','head_of_department'];

    public function head() { return $this->belongsTo(User::class, 'head_of_department'); }
    public function employees() { return $this->hasMany(Employee::class); }
}
