<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Vrtool extends Model
{
    /** @use HasFactory<\Database\Factories\VrtoolFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'body',
        'image',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Vrtool $vrtool) {
            $vrtool->slug = Str::slug($vrtool->title);
        });

        static::updating(function (Vrtool $vrtool) {
            if ($vrtool->isDirty('title')) {
                $vrtool->slug = Str::slug($vrtool->title);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'vrtool_tag');
    }

    public function vrtoolComments(): HasMany
    {
        return $this->hasMany(VrtoolComment::class)->whereNull('parent_id')->latest();
    }

    public function allVrtoolComments(): HasMany
    {
        return $this->hasMany(VrtoolComment::class);
    }

    public function vrtoolLikes(): HasMany
    {
        return $this->hasMany(VrtoolLike::class);
    }
}
