<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';
    protected $fillable = ['employee_id','date','check_in','check_out','hours_worked','status','notes','recorded_by'];
    protected $casts = ['date' => 'date'];

    public function employee() { return $this->belongsTo(Employee::class); }
    public function recordedBy() { return $this->belongsTo(User::class, 'recorded_by'); }
}
