<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    /** @use HasFactory<\Database\Factories\PageFactory> */
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'body',
        'image',
    ];

    protected static function booted(): void
    {
        static::creating(function (Page $page) {
            $page->slug = Str::slug($page->slug ?: $page->title);
        });

        static::updating(function (Page $page) {
            if ($page->isDirty('title') && ! $page->isDirty('slug')) {
                $page->slug = Str::slug($page->title);
            }
        });
    }
}
