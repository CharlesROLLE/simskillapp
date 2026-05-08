<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

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
        'slug',
    ];

    protected static function booted(): void
    {
        static::creating(function (Approach $approach) {
            $approach->slug = Str::slug($approach->icao.'-'.$approach->name);
        });

        static::updating(function (Approach $approach) {
            if ($approach->isDirty(['icao', 'name'])) {
                $approach->slug = Str::slug($approach->icao.'-'.$approach->name);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function charts(): HasMany
    {
        return $this->hasMany(Chart::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->latest();
    }

    public function allComments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
}
