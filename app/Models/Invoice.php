<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_number','client_id','created_by','type','status','vertical',
        'issue_date','due_date','subtotal','discount_percent','discount_amount',
        'tax_percent','tax_amount','total','amount_paid','balance_due',
        'currency','notes','terms','sent_at','paid_at',
    ];

    protected $casts = [
        'issue_date' => 'date', 'due_date' => 'date',
        'sent_at' => 'datetime', 'paid_at' => 'datetime',
    ];

    public function client() { return $this->belongsTo(Client::class); }
    public function createdBy() { return $this->belongsTo(User::class, 'created_by'); }
    public function items() { return $this->hasMany(InvoiceItem::class); }
    public function payments() { return $this->hasMany(Payment::class); }
    public function productionOrder() { return $this->hasOne(ProductionOrder::class); }
}
