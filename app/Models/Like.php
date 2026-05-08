<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    /** @use HasFactory<\Database\Factories\LikeFactory> */
    use HasFactory;

    protected $fillable = [
        'approach_id',
        'user_id',
    ];

    public function approach(): BelongsTo
    {
        return $this->belongsTo(Approach::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
