<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'recorded_by','supplier_id','account_id','title','description','amount',
        'currency','expense_date','category','vertical','payment_method','receipt_path','is_approved',
    ];

    protected $casts = ['expense_date' => 'date', 'is_approved' => 'boolean'];

    public function recordedBy() { return $this->belongsTo(User::class, 'recorded_by'); }
    public function supplier() { return $this->belongsTo(Supplier::class); }
    public function account() { return $this->belongsTo(ChartOfAccount::class); }
}
