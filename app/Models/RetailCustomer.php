<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RetailCustomer extends Model
{
    protected $fillable = ['name','email','phone','whatsapp','delivery_address','city','total_spent'];

    public function orders() { return $this->hasMany(EcommerceOrder::class, 'customer_id'); }
}
