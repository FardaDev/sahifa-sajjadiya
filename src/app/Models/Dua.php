<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dua extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'number',
        'title',
        'description',
    ];

    public function verses()
    {
        return $this->hasMany(Verse::class);
    }
}
