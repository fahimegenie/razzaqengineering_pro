<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

#[Fillable([
    's_image',
    's_title',
    's_description',
    's_t1',
    's_t2',
    's_t3',
    'button_text',
    'button_link',
    'is_active',
    'sort_order'
])]
class Slider extends Model
{
    use HasFactory;

    protected $table = 'slider';

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): void
    {
        $query->orderBy('sort_order');
    }

    public function getImageUrlAttribute(): string
    {
        return $this->s_image 
            ? asset('uploads/slider/' . $this->s_image) 
            : asset('images/placeholder-slider.jpg');
    }

    public function getHasButtonAttribute(): bool
    {
        return !empty($this->button_text) && !empty($this->button_link);
    }
}