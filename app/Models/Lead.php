<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = ['campaign_id','name','company','email','phone','source','interest','status','notes','assigned_to'];

    public function campaign() { return $this->belongsTo(MarketingCampaign::class); }
    public function assignedTo() { return $this->belongsTo(User::class, 'assigned_to'); }
}
