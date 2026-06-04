<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id','name','sku','description','unit','quantity',
        'min_quantity','unit_cost','supplier','location','status',
    ];

    public function category() { return $this->belongsTo(InventoryCategory::class); }
    public function transactions() { return $this->hasMany(InventoryTransaction::class, 'item_id'); }
}
