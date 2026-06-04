<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $fillable = ['employee_id','approved_by','type','start_date','end_date','days_requested','reason','status','rejection_reason'];
    protected $casts = ['start_date' => 'date', 'end_date' => 'date'];

    public function employee() { return $this->belongsTo(Employee::class); }
    public function approvedBy() { return $this->belongsTo(User::class, 'approved_by'); }
}
