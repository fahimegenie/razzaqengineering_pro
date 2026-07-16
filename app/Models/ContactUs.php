<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable([
    'cs_title',
    'cs_description',
    'map_address',
    'form_title',
    'form_description',
    'banner_image',
    'meta_title',
    'meta_description',
    'meta_keywords'
])]
class ContactUs extends Model
{
    use HasFactory;

    protected $table = 'contact_us';

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // public function getBannerUrlAttribute(): string
    // {
    //     return $this->banner_image 
    //         ? asset('uploads/contact/' . $this->banner_image) 
    //         : asset('images/contact-banner.jpg');
    // }

    public function getBannerUrlAttribute()
    {
        return $this->banner_image ? asset('storage/' . $this->banner_image) : null;
    }
}