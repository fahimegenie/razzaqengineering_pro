<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable([
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
    'company_type'
])]
class OurCompany extends Model
{
    use HasFactory;

    protected $table = 'our_company';

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function getImageUrlAttribute(int $imageNumber = 1): string
    {
        $imageField = "oc_image{$imageNumber}";
        return $this->$imageField 
            ? asset('uploads/company/' . $this->$imageField) 
            : asset('images/placeholder-company.jpg');
    }

    public function getCeoImageUrlAttribute(): string
    {
        return $this->ceo_image 
            ? asset('uploads/company/ceo/' . $this->ceo_image) 
            : asset('images/placeholder-ceo.jpg');
    }

    public function getCompanyAgeAttribute(): int
    {
        return $this->established_year 
            ? (int) date('Y') - (int) $this->established_year 
            : 0;
    }
}