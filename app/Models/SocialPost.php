<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialPost extends Model
{
    protected $fillable = ['campaign_id','created_by','content','media','platforms','scheduled_at','published_at','status'];
    protected $casts = ['media' => 'array', 'platforms' => 'array', 'scheduled_at' => 'datetime', 'published_at' => 'datetime'];

    public function campaign() { return $this->belongsTo(MarketingCampaign::class); }
    public function createdBy() { return $this->belongsTo(User::class, 'created_by'); }
}
