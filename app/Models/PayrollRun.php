<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollRun extends Model
{
    protected $fillable = ['period','pay_date','status','total_gross','total_paye','total_napsa','total_nhima','total_net','processed_by'];
    protected $casts = ['pay_date' => 'date'];

    public function processedBy() { return $this->belongsTo(User::class, 'processed_by'); }
    public function payslips() { return $this->hasMany(Payslip::class); }
}
