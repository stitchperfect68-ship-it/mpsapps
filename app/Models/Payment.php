<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['invoice_id','recorded_by','amount','currency','method','reference','payment_date','notes'];
    protected $casts = ['payment_date' => 'date'];

    public function invoice() { return $this->belongsTo(Invoice::class); }
    public function recordedBy() { return $this->belongsTo(User::class, 'recorded_by'); }
}
