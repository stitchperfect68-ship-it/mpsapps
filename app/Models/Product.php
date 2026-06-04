<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id','name','slug','sku','description','price','compare_price',
        'stock_quantity','is_custom_order','is_published','images','variants',
        'tags','vertical','featured',
    ];

    protected $casts = [
        'images' => 'array', 'variants' => 'array', 'tags' => 'array',
        'is_custom_order' => 'boolean', 'is_published' => 'boolean', 'featured' => 'boolean',
    ];

    public function category() { return $this->belongsTo(ProductCategory::class); }
    public function orderItems() { return $this->hasMany(EcommerceOrderItem::class); }
}
