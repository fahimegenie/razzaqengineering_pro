<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
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
        'sort_order',
    ];

    protected $casts = [
        'p_gallery' => 'array',
        'p_start_date' => 'date',
        'p_end_date' => 'date',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Project $project) {
            if (empty($project->p_slug)) {
                $project->p_slug = Str::slug($project->p_title);
            }
            if (empty($project->sort_order)) {
                $project->sort_order = self::max('sort_order') + 1;
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'pc_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'ASC')->orderBy('p_start_date', 'DESC');
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('p_status', $status);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('pc_id', $categoryId);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->p_image) {
            $paths = [
                public_path('p_image/' . $this->p_image),
                public_path('storage/p_image/' . $this->p_image),
            ];
            foreach ($paths as $path) {
                if (file_exists($path)) {
                    return asset(str_replace(public_path(), '', $path));
                }
            }
        }
        return asset('images/placeholder-project.jpg');
    }

    public function getGalleryUrlsAttribute(): array
    {
        return collect($this->p_gallery ?? [])->map(function ($image) {
            if (file_exists(public_path('uploads/projects/gallery/' . $image))) {
                return asset('uploads/projects/gallery/' . $image);
            }
            return null;
        })->filter()->values()->toArray();
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->p_status) {
            'completed' => '<span class="badge bg-success">Completed</span>',
            'ongoing' => '<span class="badge bg-primary">Ongoing</span>',
            'planning' => '<span class="badge bg-warning">Planning</span>',
            'on-hold' => '<span class="badge bg-secondary">On Hold</span>',
            'cancelled' => '<span class="badge bg-danger">Cancelled</span>',
            default => '<span class="badge bg-info">' . ucfirst($this->p_status ?? 'Unknown') . '</span>',
        };
    }

    public function getDurationAttribute(): string
    {
        if ($this->p_start_date && $this->p_end_date) {
            return $this->p_start_date->diffInDays($this->p_end_date) . ' days';
        }
        return 'N/A';
    }

    public function getFormattedStartDateAttribute(): string
    {
        return $this->p_start_date ? $this->p_start_date->format('M d, Y') : 'N/A';
    }

    public function getFormattedEndDateAttribute(): string
    {
        return $this->p_end_date ? $this->p_end_date->format('M d, Y') : 'N/A';
    }

    public static function getTotalProjects(): int
    {
        return self::count();
    }

    public static function getActiveProjects(): int
    {
        return self::active()->count();
    }

    public static function getFeaturedProjects(): int
    {
        return self::featured()->count();
    }

    public static function getCompletedProjects(): int
    {
        return self::where('p_status', 'completed')->count();
    }

    public function getRouteKeyName(): string
    {
        return 'p_slug';
    }
}