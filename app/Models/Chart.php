<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chart extends Model
{
    /** @use HasFactory<\Database\Factories\ChartFactory> */
    use HasFactory;

    protected $fillable = [
        'approach_id',
        'name',
        'image',
    ];

    public function approach(): BelongsTo
    {
        return $this->belongsTo(Approach::class);
    }
}
