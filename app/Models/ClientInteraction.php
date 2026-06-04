<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientInteraction extends Model
{
    protected $fillable = ['client_id','user_id','type','subject','notes','follow_up_date'];
    protected $casts = ['follow_up_date' => 'date'];

    public function client() { return $this->belongsTo(Client::class); }
    public function user() { return $this->belongsTo(User::class); }
}
