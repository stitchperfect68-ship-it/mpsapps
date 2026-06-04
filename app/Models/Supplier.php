<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['name','company','email','phone','address','tpin','category','outstanding_balance','is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function expenses() { return $this->hasMany(Expense::class); }
}
