<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

#[Fillable([
    'bt_name',
    'bt_slug',
    'bt_description',
    'is_active',
    'sort_order'
])]
class BlogTag extends Model
{
    use HasFactory;

    protected $table = 'blog_tags';

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (BlogTag $tag) {
            if (empty($tag->bt_slug)) {
                $tag->bt_slug = Str::slug($tag->bt_name);
            }
        });
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function posts()
    {
        return $this->belongsToMany(BlogPost::class, 'blog_post_tags', 'tag_id', 'post_id');
    }

    public function getRouteKeyName(): string
    {
        return 'bt_slug';
    }

    public function getPostsCountAttribute(): int
    {
        return $this->posts()->published()->count();
    }
}