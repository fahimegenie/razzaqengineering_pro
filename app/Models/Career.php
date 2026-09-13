<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Career extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'careers';

    protected $fillable = [
        'title',
        'slug',
        'department',
        'location',
        'job_type',
        'salary_range',
        'experience',
        'qualification',
        'description',
        'requirements',
        'benefits',
        'is_active',
        'sort_order',
        'closing_date',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'closing_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // ============================================
    // BOOT
    // ============================================

    protected static function booted(): void
    {
        static::creating(function (Career $career) {
            if (empty($career->slug)) {
                $career->slug = Str::slug($career->title);
            }
            if (empty($career->sort_order)) {
                $career->sort_order = self::max('sort_order') + 1;
            }
        });

        static::updating(function (Career $career) {
            if ($career->isDirty('title') && !$career->isDirty('slug')) {
                $career->slug = Str::slug($career->title);
            }
        });
    }

    // ============================================
    // RELATIONSHIPS
    // ============================================

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    // ============================================
    // SCOPES
    // ============================================

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('closing_date')
                  ->orWhere('closing_date', '>=', now());
            });
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'ASC')
                     ->orderBy('created_at', 'DESC');
    }

    public function scopeByDepartment($query, $department)
    {
        return $query->where('department', $department);
    }

    public function scopeByLocation($query, $location)
    {
        return $query->where('location', $location);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('job_type', $type);
    }

    // ============================================
    // ACCESSORS
    // ============================================

    public function getShortDescriptionAttribute(): string
    {
        return Str::limit(strip_tags($this->description ?? ''), 150);
    }

    public function getIsOpenAttribute(): bool
    {
        if (!$this->is_active) return false;
        if ($this->closing_date && $this->closing_date->isPast()) return false;
        return true;
    }

    public function getApplicationsCountAttribute(): int
    {
        return $this->applications()->count();
    }

    // ============================================
    // STATIC METHODS
    // ============================================

    public static function getTotalJobs(): int
    {
        return self::active()->count();
    }

    public static function getDepartments(): array
    {
        return self::active()->distinct()->whereNotNull('department')->pluck('department')->toArray();
    }

    public static function getLocations(): array
    {
        return self::active()->distinct()->whereNotNull('location')->pluck('location')->toArray();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}