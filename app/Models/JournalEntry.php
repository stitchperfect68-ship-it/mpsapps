<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    protected $fillable = ['reference','user_id','entry_date','description','source','source_id'];
    protected $casts = ['entry_date' => 'date'];

    public function user() { return $this->belongsTo(User::class); }
    public function lines() { return $this->hasMany(JournalLine::class); }
}
