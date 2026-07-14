<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

#[Fillable([
    'post_id',
    'user_id',
    'parent_id',
    'commenter_name',
    'commenter_email',
    'commenter_website',
    'comment_content',
    'comment_status',
    'ip_address',
    'user_agent'
])]
class BlogComment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blog_comments';

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(BlogPost::class, 'post_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(BlogComment::class, 'parent_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(BlogComment::class, 'parent_id');
    }

    public function scopeApproved(Builder $query): void
    {
        $query->where('comment_status', 'approved');
    }

    public function scopePending(Builder $query): void
    {
        $query->where('comment_status', 'pending');
    }

    public function getIsApprovedAttribute(): bool
    {
        return $this->comment_status === 'approved';
    }

    public function getGravatarUrlAttribute(): string
    {
        $hash = md5(strtolower(trim($this->commenter_email)));
        return "https://www.gravatar.com/avatar/{$hash}?d=mp&s=80";
    }
}