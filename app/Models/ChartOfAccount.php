<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChartOfAccount extends Model
{
    protected $fillable = ['code','name','type','sub_type','is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function journalLines() { return $this->hasMany(JournalLine::class, 'account_id'); }
}
