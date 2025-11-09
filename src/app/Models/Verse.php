<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Verse extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'dua_id',
        'text',
        'translation',
        'order',
    ];

    public function dua(): BelongsTo
    {
        return $this->belongsTo(Dua::class);
    }
}
