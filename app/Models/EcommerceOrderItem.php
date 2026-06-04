<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcommerceOrderItem extends Model
{
    protected $fillable = ['order_id','product_id','product_name','quantity','unit_price','total','variant_options'];
    protected $casts = ['variant_options' => 'array'];

    public function order() { return $this->belongsTo(EcommerceOrder::class); }
    public function product() { return $this->belongsTo(Product::class); }
}
