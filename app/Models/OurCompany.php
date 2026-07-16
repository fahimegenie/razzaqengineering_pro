<?php
// app/Models/OurCompany.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class OurCompany extends Model
{
    use HasFactory;

    protected $table = 'our_company';

    protected $fillable = [
        'oc_title',
        'oc_description',
        'oc_image1',
        'oc_image2',
        'oc_image3',
        'oc_image4',
        'ceo_name',
        'ceo_image',
        'ceo_message',
        'established_year',
        'company_type',
        'our_company_category',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // ============================================
    // SCOPES
    // ============================================
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'DESC');
    }

    // ============================================
    // CACHING
    // ============================================

    public static function getCached()
    {
        return Cache::remember('our_companies', 3600, function () {
            return static::active()->ordered()->get();
        });
    }

    protected static function booted(): void
    {
        static::saved(function ($model) {
            Cache::forget('our_companies');
        });

        static::deleted(function ($model) {
            Cache::forget('our_companies');
            // Clean up images
            for ($i = 1; $i <= 4; $i++) {
                $field = "oc_image{$i}";
                if ($model->$field) {
                    Storage::disk('public')->delete('uploads/company/' . $model->$field);
                }
            }
            if ($model->ceo_image) {
                Storage::disk('public')->delete('uploads/company/ceo/' . $model->ceo_image);
            }
        });
    }

    // ============================================
    // IMAGE ACCESSORS
    // ============================================

    public function getImageUrl(int $imageNumber = 1): string
    {
        $imageField = "oc_image{$imageNumber}";
        if ($this->$imageField) {
            $path = 'slider_image/' . $this->$imageField;
            if (Storage::disk('public')->exists($path)) {
                return asset('storage/' . $path);
            }
            // Fallback paths
            if (file_exists(public_path('slider_image/' . $this->$imageField))) {
                return asset('slider_image/' . $this->$imageField);
            }
        }
        return asset('images/placeholder-company.jpg');
    }

    public function getImage1UrlAttribute(): string
    {
        return $this->getImageUrl(1);
    }

    public function getImage2UrlAttribute(): string
    {
        return $this->getImageUrl(2);
    }

    public function getImage3UrlAttribute(): string
    {
        return $this->getImageUrl(3);
    }

    public function getImage4UrlAttribute(): string
    {
        return $this->getImageUrl(4);
    }

    public function getCeoImageUrlAttribute(): string
    {
        if ($this->ceo_image) {
            $path = 'uploads/company/ceo/' . $this->ceo_image;
            if (Storage::disk('public')->exists($path)) {
                return asset('storage/' . $path);
            }
            if (file_exists(public_path('images/' . $this->ceo_image))) {
                return asset('images/' . $this->ceo_image);
            }
        }
        return asset('images/placeholder-ceo.jpg');
    }

    public function getAllImagesAttribute(): array
    {
        $images = [];
        for ($i = 1; $i <= 4; $i++) {
            $url = $this->getImageUrl($i);
            if (!str_contains($url, 'placeholder')) {
                $images[] = [
                    'number' => $i,
                    'url' => $url,
                    'field' => "oc_image{$i}",
                ];
            }
        }
        return $images;
    }

    // ============================================
    // COMPUTED ATTRIBUTES
    // ============================================

    public function getCompanyAgeAttribute(): int
    {
        return $this->established_year 
            ? (int) date('Y') - (int) $this->established_year 
            : 0;
    }

    public function getHasCeoAttribute(): bool
    {
        return !empty($this->ceo_name) && !empty($this->ceo_image);
    }

    public function getImageCountAttribute(): int
    {
        $count = 0;
        for ($i = 1; $i <= 4; $i++) {
            $field = "oc_image{$i}";
            if (!empty($this->$field)) $count++;
        }
        return $count;
    }

    public function getShortDescriptionAttribute(): string
    {
        return \Illuminate\Support\Str::limit(strip_tags($this->oc_description ?? ''), 150);
    }
}