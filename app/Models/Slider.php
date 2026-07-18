<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Carbon;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'slider';

    protected $fillable = [
        's_image',
        's_mobile_image',
        's_video',
        's_alt_text',
        's_title',
        's_subtitle',
        's_description',
        's_badge_text',
        's_t1',
        's_t2',
        's_t3',
        'button_text',
        'button_link',
        'button_target',
        'button2_text',
        'button2_link',
        'button2_target',
        'slider_type',
        'text_position',
        'text_color',
        'overlay_color',
        'overlay_opacity',
        'background_color',
        'background_position',
        'background_size',
        'animation_type',
        'slide_duration',
        'external_link',
        'tracking_code',
        'start_date',
        'end_date',
        'is_active',
        'is_featured',
        'show_on_mobile',
        'show_on_desktop',
        'sort_order',
        'meta_data'
    ];

    // Laravel 13 uses $casts property (not casts() method)
    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'show_on_mobile' => 'boolean',
        'show_on_desktop' => 'boolean',
        'sort_order' => 'integer',
        'overlay_opacity' => 'integer',
        'slide_duration' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'meta_data' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ============ SCOPES ============
    
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order', 'asc');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where(function($q) {
            $q->whereNull('start_date')
              ->orWhere('start_date', '<=', now());
        })->where(function($q) {
            $q->whereNull('end_date')
              ->orWhere('end_date', '>=', now());
        });
    }

    public function scopeForDevice(Builder $query, string $device = 'desktop'): Builder
    {
        if ($device === 'mobile') {
            return $query->where('show_on_mobile', true);
        }
        return $query->where('show_on_desktop', true);
    }

    // ============ ACCESSORS ============
    
    public function getImageUrlAttribute(): string
    {
        return $this->s_image 
            ? asset($this->s_image) 
            : asset('images/placeholder-slider.jpg');
    }

    public function getMobileImageUrlAttribute(): string
    {
        return $this->s_mobile_image 
            ? asset($this->s_mobile_image) 
            : $this->image_url;
    }

    public function getVideoUrlAttribute(): string
    {
        return $this->s_video 
            ? asset($this->s_video) 
            : '';
    }

    public function getHasButtonAttribute(): bool
    {
        return !empty($this->button_text) && !empty($this->button_link);
    }

    public function getHasButton2Attribute(): bool
    {
        return !empty($this->button2_text) && !empty($this->button2_link);
    }

    public function getOverlayStyleAttribute(): string
    {
        $color = $this->overlay_color ?? '#00366c';
        $opacity = $this->overlay_opacity ?? 50;
        
        // Gradient with proper opacity
        return "background: linear-gradient(135deg, rgba(0,54,108,0.85) 0%, rgba(0,54,108,0.4) 50%, rgba(40,167,69,0.75) 100%);";
    }

    public function getTextColorAttribute($value): string
    {
        return $value ?? '#ffffff';
    }

    public function getSlideDurationAttribute($value): int
    {
        return (int)($value ?? 5000);
    }

    public function getAnimationTypeAttribute($value): string
    {
        return $value ?? 'fade';
    }

    public function getTextPositionAttribute($value): string
    {
        return $value ?? 'center';
    }

    public function getButtonTargetAttribute($value): string
    {
        return $value ?? '_self';
    }

    public function getButton2TargetAttribute($value): string
    {
        return $value ?? '_self';
    }

    // ============ HELPER METHODS ============
    
    public function isActive(): bool
    {
        if (!$this->is_active) return false;
        
        // Check scheduling
        if ($this->start_date && now()->lt($this->start_date)) return false;
        if ($this->end_date && now()->gt($this->end_date)) return false;
        
        return true;
    }

    public function getBackgroundStyleAttribute(): string
    {
        $styles = [];

        if ($this->background_color) {
            $styles[] = "background-color: {$this->background_color};";
        }

        if ($this->s_image) {
            $styles[] = "background-image: url('{$this->image_url}');";

            $backgroundSize = $this->background_size ?? 'cover';
            $backgroundPosition = $this->background_position ?? 'center';

            $styles[] = "background-size: {$backgroundSize};";
            $styles[] = "background-position: {$backgroundPosition};";
            $styles[] = "background-repeat: no-repeat;";
        }

        return implode(' ', $styles);
    }

    public function getResponsiveImageAttribute(): string
    {
        // Check if mobile and has mobile image
        if ($this->s_mobile_image && Request::isMobile()) {
            return $this->mobile_image_url;
        }
        return $this->image_url;
    }

    public function getFeatureItemsAttribute(): array
    {
        $features = [];
        if ($this->s_t1) $features[] = $this->s_t1;
        if ($this->s_t2) $features[] = $this->s_t2;
        if ($this->s_t3) $features[] = $this->s_t3;
        return $features;
    }

    public function getButtonsAttribute(): array
    {
        $buttons = [];
        
        if ($this->has_button) {
            $buttons[] = [
                'text' => $this->button_text,
                'link' => $this->button_link,
                'target' => $this->button_target,
                'type' => 'primary'
            ];
        }
        
        if ($this->has_button2) {
            $buttons[] = [
                'text' => $this->button2_text,
                'link' => $this->button2_link,
                'target' => $this->button2_target,
                'type' => 'secondary'
            ];
        }
        
        return $buttons;
    }

    public function getAnimationClassAttribute(): string
    {
        $animations = [
            'fade' => 'animate__fadeIn',
            'slide' => 'animate__slideInUp',
            'zoom' => 'animate__zoomIn',
            'bounce' => 'animate__bounceIn',
            'flip' => 'animate__flipInX',
            'slide_left' => 'animate__slideInLeft',
            'slide_right' => 'animate__slideInRight',
        ];
        
        return $animations[$this->animation_type] ?? 'animate__fadeIn';
    }

    public function getDelayAttribute(): string
    {
        $delays = [
            1 => 'animate__delay-1s',
            2 => 'animate__delay-2s',
            3 => 'animate__delay-3s',
            4 => 'animate__delay-4s',
        ];
        return $delays[$this->delay_index ?? 1] ?? 'animate__delay-1s';
    }

    // ============ QUERY HELPER ============
    
    /**
     * Get all active slides for frontend
     */
    public static function getActiveSlides(string $device = 'desktop'): \Illuminate\Database\Eloquent\Collection
    {
        return self::active()
            ->published()
            ->forDevice($device)
            ->ordered()
            ->get();
    }
}