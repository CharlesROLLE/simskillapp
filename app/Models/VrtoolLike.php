<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VrtoolLike extends Model
{
    /** @use HasFactory<\Database\Factories\VrtoolLikeFactory> */
    use HasFactory;

    protected $fillable = [
        'vrtool_id',
        'user_id',
    ];

    public function vrtool(): BelongsTo
    {
        return $this->belongsTo(Vrtool::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
