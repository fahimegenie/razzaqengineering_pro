<?php
// app/Models/FleetItem.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class FleetItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'fleet_category_id',
        'title',
        'slug',
        'description',
        'image',
        'features',
        'specifications',
        'manufacturer',
        'model_number',
        'sort_order',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'features' => 'array',
        'specifications' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($item) {
            if (empty($item->slug)) {
                $item->slug = Str::slug($item->title);
            }
        });

        static::updating(function ($item) {
            if ($item->isDirty('title') && !$item->isDirty('slug')) {
                $item->slug = Str::slug($item->title);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(FleetCategory::class, 'fleet_category_id');
    }

    public function media()
    {
        return $this->hasMany(FleetMedia::class)->orderBy('sort_order');
    }

    public function primaryMedia()
    {
        return $this->hasOne(FleetMedia::class)->where('is_primary', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset($this->image);
        }
        
        if ($this->primaryMedia) {
            return asset($this->primaryMedia->file_path);
        }
        
        return asset('images/placeholder-fleet.jpg');
    }
}