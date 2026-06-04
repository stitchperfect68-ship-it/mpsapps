<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcommerceOrder extends Model
{
    protected $fillable = [
        'order_number','customer_id','status','subtotal','delivery_fee','total',
        'payment_status','payment_method','delivery_address','delivery_method','channel','notes',
    ];

    public function customer() { return $this->belongsTo(RetailCustomer::class); }
    public function items() { return $this->hasMany(EcommerceOrderItem::class, 'order_id'); }
}
