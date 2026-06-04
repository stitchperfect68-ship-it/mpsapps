<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = ['name','slug','parent_category','vertical','image'];

    public function products() { return $this->hasMany(Product::class, 'category_id'); }
}
