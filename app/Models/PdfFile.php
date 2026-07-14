<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PdfFile extends Model
{
    protected $table = 'upload_pdf';
    protected $primaryKey = 'pdf_id';
    
    protected $fillable = [
        'pdf_name',
        'pdf_title',
        'pdf_description',
        'pdf_category',
        'pdf_file_size',
        'is_active',
        'sort_order',
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
    
    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'ASC');
    }
    
    public function scopeByCategory($query, $category)
    {
        return $query->where('pdf_category', $category);
    }
    
    // Accessors
    public function getPdfUrlAttribute()
    {
        return $this->pdf_name ? asset('storage/pdfs/'.$this->pdf_name) : null;
    }
    
    public function getFileNameAttribute()
    {
        return pathinfo($this->pdf_name, PATHINFO_FILENAME);
    }
    
    public function getFileExtensionAttribute()
    {
        return pathinfo($this->pdf_name, PATHINFO_EXTENSION);
    }
    
    public function getFileSizeFormattedAttribute()
    {
        if (!$this->pdf_file_size) {
            return 'N/A';
        }
        
        $bytes = $this->pdf_file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }
    
    public function getFileIconAttribute()
    {
        return asset('images/pdf-icon.png');
    }
    
    // Helper Methods
    public function fileExists()
    {
        return $this->pdf_name && Storage::disk('public')->exists('pdfs/'.$this->pdf_name);
    }
    
    public function getDownloadCount()
    {
        // You can add a downloads table to track this
        return $this->downloads()->count();
    }
    
    public function incrementDownloadCount()
    {
        // Optional: Track downloads
        // DB::table('pdf_downloads')->insert([
        //     'pdf_id' => $this->pdf_id,
        //     'downloaded_at' => now(),
        //     'ip_address' => request()->ip(),
        // ]);
    }
    
    public static function getCategories()
    {
        return self::where('is_active', 1)
            ->whereNotNull('pdf_category')
            ->distinct()
            ->pluck('pdf_category');
    }
    
    // Boot Method
    protected static function boot()
    {
        parent::boot();
        
        static::deleting(function ($pdfFile) {
            // Delete physical file when record is deleted
            if ($pdfFile->fileExists()) {
                Storage::disk('public')->delete('pdfs/'.$pdfFile->pdf_name);
            }
        });
        
        static::saving(function ($pdfFile) {
            // Auto-calculate file size
            if ($pdfFile->pdf_name && $pdfFile->fileExists()) {
                $pdfFile->pdf_file_size = Storage::disk('public')->size('pdfs/'.$pdfFile->pdf_name);
            }
        });
    }
}