<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id','department_id','employee_number','first_name','last_name','email','phone',
        'national_id','napsa_number','nhima_number','tpin','employment_type','job_title',
        'vertical','basic_salary','salary_type','hire_date','end_date','status',
        'address','emergency_contact','bank_name','bank_account','mobile_money_number',
    ];

    protected $casts = ['hire_date' => 'date', 'end_date' => 'date'];

    public function user() { return $this->belongsTo(User::class); }
    public function department() { return $this->belongsTo(Department::class); }
    public function attendance() { return $this->hasMany(Attendance::class); }
    public function leaveRequests() { return $this->hasMany(LeaveRequest::class); }
    public function payslips() { return $this->hasMany(Payslip::class); }

    public function getNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
