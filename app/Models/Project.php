<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

#[Fillable([
    'p_title',
    'p_slug',
    'p_image',
    'p_description',
    'p_short_description',
    'p_category',
    'pc_id',
    'p_location',
    'p_client',
    'p_start_date',
    'p_end_date',
    'p_status',
    'p_gallery',
    'is_active',
    'is_featured',
    'sort_order'
])]
class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected function casts(): array
    {
        return [
            'p_gallery' => 'array',
            'p_start_date' => 'date',
            'p_end_date' => 'date',
            'p_status' => 'string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Project $project) {
            if (empty($project->p_slug)) {
                $project->p_slug = Str::slug($project->p_title);
            }
        });
    }

    public function getSlugAttribute()
    {
        $value = $this->p_name ?: $this->p_title;

        // custom replacements
        $value = str_replace(['(', ')', '?'], '_', $value);

        // spaces to dash
        $value = preg_replace('/\s+/', '-', $value);

        // remove unwanted characters except - and _
        $value = preg_replace('/[^A-Za-z0-9\-_]/', '', $value);

        return strtolower(trim($value, '-'));
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'pc_id');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    public function scopeCompleted(Builder $query): void
    {
        $query->where('p_status', 'completed');
    }

    public function scopeOngoing(Builder $query): void
    {
        $query->where('p_status', 'ongoing');
    }

    public function scopeOrdered(Builder $query): void
    {
        $query->orderBy('sort_order')->orderBy('p_start_date', 'desc');
    }

    public function scopeByLocation(Builder $query, string $location): void
    {
        $query->where('p_location', 'like', "%{$location}%");
    }

    public function getImageUrlAttribute(): string
    {
        return $this->p_image 
            ? asset('uploads/projects/' . $this->p_image) 
            : asset('images/placeholder-project.jpg');
    }

    public function getGalleryUrlsAttribute(): array
    {
        return collect($this->p_gallery ?? [])->map(function ($image) {
            return asset('uploads/projects/gallery/' . $image);
        })->toArray();
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->p_status) {
            'completed' => '<span class="badge bg-success">Completed</span>',
            'ongoing' => '<span class="badge bg-primary">Ongoing</span>',
            'planning' => '<span class="badge bg-warning">Planning</span>',
            'on-hold' => '<span class="badge bg-secondary">On Hold</span>',
            default => '<span class="badge bg-info">' . ucfirst($this->p_status) . '</span>',
        };
    }

    public function getDurationAttribute(): string
    {
        if ($this->p_start_date && $this->p_end_date) {
            return $this->p_start_date->diffInDays($this->p_end_date) . ' days';
        }
        return 'N/A';
    }

    public function getRouteKeyName(): string
    {
        return 'p_slug';
    }
}