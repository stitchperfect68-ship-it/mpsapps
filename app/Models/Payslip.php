<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    protected $fillable = [
        'payroll_run_id','employee_id','basic_salary','allowances','gross_pay',
        'paye_tax','napsa_employee','napsa_employer','nhima_employee','nhima_employer',
        'other_deductions','net_pay','days_worked','days_absent','deductions_breakdown','allowances_breakdown',
    ];

    protected $casts = ['deductions_breakdown' => 'array', 'allowances_breakdown' => 'array'];

    public function payrollRun() { return $this->belongsTo(PayrollRun::class); }
    public function employee() { return $this->belongsTo(Employee::class); }
}
