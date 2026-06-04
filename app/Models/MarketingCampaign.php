<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketingCampaign extends Model
{
    protected $fillable = ['created_by','name','description','type','status','start_date','end_date','budget','actual_spend','target_audience','metrics'];
    protected $casts = ['start_date' => 'date', 'end_date' => 'date', 'target_audience' => 'array', 'metrics' => 'array'];

    public function createdBy() { return $this->belongsTo(User::class, 'created_by'); }
    public function posts() { return $this->hasMany(SocialPost::class, 'campaign_id'); }
    public function leads() { return $this->hasMany(Lead::class, 'campaign_id'); }
}
