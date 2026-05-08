<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VrtoolComment extends Model
{
    /** @use HasFactory<\Database\Factories\VrtoolCommentFactory> */
    use HasFactory;

    protected $fillable = [
        'vrtool_id',
        'user_id',
        'parent_id',
        'body',
    ];

    protected $with = ['user'];

    public function vrtool(): BelongsTo
    {
        return $this->belongsTo(Vrtool::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(VrtoolComment::class, 'parent_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(VrtoolComment::class, 'parent_id');
    }
}
