<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    protected $fillable = ['item_id','user_id','type','quantity','quantity_before','quantity_after','reference','notes'];

    public function item() { return $this->belongsTo(InventoryItem::class); }
    public function user() { return $this->belongsTo(User::class); }
}
