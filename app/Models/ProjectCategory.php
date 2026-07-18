<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ProjectCategory extends Model
{
    use HasFactory;

    protected $table = 'project_category';

    protected $fillable = [
        'pc_name',
        'pc_slug',
        'pc_description',
        'pc_image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (ProjectCategory $category) {
            if (empty($category->pc_slug)) {
                $category->pc_slug = Str::slug($category->pc_name);
            }
        });
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'pc_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'ASC')->orderBy('pc_name', 'ASC');
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->pc_image) {
            if (file_exists(public_path($this->pc_image))) {
                return asset($this->pc_image);
            }
        }
        return asset('images/placeholder-category.jpg');
    }

    public function getProjectsCountAttribute(): int
    {
        return $this->projects()->count();
    }

    public static function getTotalCategories(): int
    {
        return self::count();
    }

    public static function getActiveCategories(): int
    {
        return self::active()->count();
    }

    public function getRouteKeyName(): string
    {
        return 'pc_slug';
    }
}