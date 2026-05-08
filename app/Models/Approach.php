<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Approach extends Model
{
    /** @use HasFactory<\Database\Factories\ApproachFactory> */
    use HasFactory;

    protected $fillable = [
        'icao',
        'name',
        'country',
        'city',
        'extract',
        'description',
        'image',
    ];

    public function charts(): HasMany
    {
        return $this->hasMany(Chart::class);
    }
}
