<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

#[Fillable([
    'bp_title',
    'bp_slug',
    'bp_excerpt',
    'bp_content',
    'featured_image',
    'banner_image',
    'video_url',
    'category_id',
    'author_id',
    'bp_status',
    'published_at',
    'is_featured',
    'is_trending',
    'allow_comments',
    'views_count',
    'reading_time',
    'bp_format',
    'gallery_images',
    'audio_url',
    'attachments',
    'meta_title',
    'meta_description',
    'meta_keywords',
    'og_image',
    'canonical_url',
    'schema_markup',
    'structured_data'
])]
class BlogPost extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blog_posts';

    protected function casts(): array
    {
        return [
            'gallery_images' => 'array',
            'attachments' => 'array',
            'structured_data' => 'array',
            'is_featured' => 'boolean',
            'is_trending' => 'boolean',
            'allow_comments' => 'boolean',
            'views_count' => 'integer',
            'reading_time' => 'integer',
            'published_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (BlogPost $post) {
            if (empty($post->bp_slug)) {
                $post->bp_slug = Str::slug($post->bp_title);
            }
            $post->reading_time = static::calculateReadingTime($post->bp_content);
        });

        static::updating(function (BlogPost $post) {
            if ($post->isDirty('bp_content')) {
                $post->reading_time = static::calculateReadingTime($post->bp_content);
            }
        });
    }

    protected static function calculateReadingTime(string $content): int
    {
        $words = str_word_count(strip_tags($content));
        return (int) ceil($words / 200);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(BlogTag::class, 'blog_post_tags', 'post_id', 'tag_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(BlogComment::class, 'post_id');
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('bp_status', 'published')
            ->where('published_at', '<=', now());
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'DESC')
                    ->orderBy('created_at', 'DESC');
    }

    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    public function scopeTrending(Builder $query): void
    {
        $query->where('is_trending', true)->orderBy('views_count', 'desc');
    }

    public function scopeByCategory(Builder $query, int $categoryId): void
    {
        $query->where('category_id', $categoryId);
    }

    public function scopeByTag(Builder $query, int $tagId): void
    {
        $query->whereHas('tags', function ($q) use ($tagId) {
            $q->where('blog_tags.id', $tagId);
        });
    }

    public function getImageUrlAttribute(): string
    {
        return $this->featured_image 
            ? asset('uploads/blog/' . $this->featured_image) 
            : asset('images/placeholder-blog.jpg');
    }

    public function getBannerUrlAttribute(): string
    {
        return $this->banner_image 
            ? asset('uploads/blog/banners/' . $this->banner_image) 
            : $this->image_url;
    }

    public function getGalleryUrlsAttribute(): array
    {
        return collect($this->gallery_images ?? [])->map(function ($image) {
            return asset('uploads/blog/gallery/' . $image);
        })->toArray();
    }

    public function getApprovedCommentsCountAttribute(): int
    {
        return $this->comments()->where('comment_status', 'approved')->count();
    }

    public function getMetaTitleAttribute($value): string
    {
        return $value ?? $this->bp_title . ' - Blog | Razzaq Engineering';
    }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    public function getRouteKeyName(): string
    {
        return 'bp_slug';
    }
}