<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductionOrder extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_number','client_id','invoice_id','assigned_to','vertical','product_type',
        'brief','quantity','stage','stage_progress','measurements','fabric_requirements',
        'colour_specs','quoted_price','start_date','due_date','completed_date',
        'priority','qc_passed','qc_notes','internal_notes',
    ];

    protected $casts = [
        'measurements' => 'array', 'fabric_requirements' => 'array', 'colour_specs' => 'array',
        'start_date' => 'date', 'due_date' => 'date', 'completed_date' => 'date',
        'qc_passed' => 'boolean',
    ];

    public function client() { return $this->belongsTo(Client::class); }
    public function invoice() { return $this->belongsTo(Invoice::class); }
    public function assignedTo() { return $this->belongsTo(User::class, 'assigned_to'); }
    public function stageLogs() { return $this->hasMany(ProductionStageLog::class, 'order_id'); }
}
