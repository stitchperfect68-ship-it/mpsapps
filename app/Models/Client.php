<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name','type','company','industry','contact_person','email','phone',
        'whatsapp','address','city','country','status','tier','notes',
        'referral_source','assigned_to','lifetime_value',
    ];

    public function invoices() { return $this->hasMany(Invoice::class); }
    public function productionOrders() { return $this->hasMany(ProductionOrder::class); }
    public function interactions() { return $this->hasMany(ClientInteraction::class); }
    public function projects() { return $this->hasMany(Project::class); }
    public function assignedTo() { return $this->belongsTo(User::class, 'assigned_to'); }
}
