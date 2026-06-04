<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionStageLog extends Model
{
    public $timestamps = false;
    protected $fillable = ['order_id','user_id','from_stage','to_stage','notes','created_at'];

    public function order() { return $this->belongsTo(ProductionOrder::class); }
    public function user() { return $this->belongsTo(User::class); }
}
