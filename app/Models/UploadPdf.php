<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

#[Fillable([
    'pdf_name',
    'pdf_title',
    'pdf_description',
    'pdf_category',
    'pdf_file_size',
    'is_active',
    'sort_order'
])]
class UploadPdf extends Model
{
    use HasFactory;

    protected $table = 'upload_pdf';

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

    public function scopeByCategory(Builder $query, string $category): void
    {
        $query->where('pdf_category', $category);
    }

    public function getPdfUrlAttribute(): string
    {
        return $this->pdf_name 
            ? asset('uploads/pdf/' . $this->pdf_name) 
            : '#';
    }

    public function getFileNameAttribute(): string
    {
        return $this->pdf_title ?? basename($this->pdf_name);
    }

    public function getFileSizeFormattedAttribute(): string
    {
        if (!$this->pdf_file_size) {
            return 'Unknown';
        }
        
        $size = (int) $this->pdf_file_size;
        if ($size < 1024) return $size . ' B';
        if ($size < 1048576) return round($size / 1024, 2) . ' KB';
        return round($size / 1048576, 2) . ' MB';
    }
}