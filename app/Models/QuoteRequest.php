<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class QuoteRequest extends Model
{
    protected $table = 'quote_requests';
    
    protected $fillable = [
        'qr_name',
        'qr_email',
        'qr_phone',
        'qr_company',
        'qr_service_type',
        'qr_location',
        'qr_details',
        'qr_budget',
        'qr_timeline',
        'qr_source',
        'qr_attachment',
        'qr_status',
        'qr_ip',
        'qr_user_agent',
        'qr_admin_notes',
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    // Scopes
    public function scopePending($query)
    {
        return $query->where('qr_status', 'pending');
    }
    
    public function scopeContacted($query)
    {
        return $query->where('qr_status', 'contacted');
    }
    
    public function scopeCompleted($query)
    {
        return $query->where('qr_status', 'completed');
    }
    
    public function scopeCancelled($query)
    {
        return $query->where('qr_status', 'cancelled');
    }
    
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }
    
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
    }
    
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month);
    }
    
    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }
    
    // Accessors
    public function getStatusBadgeAttribute(): string
    {
        return match($this->qr_status) {
            'pending' => '<span class="badge bg-warning">Pending</span>',
            'contacted' => '<span class="badge bg-info">Contacted</span>',
            'completed' => '<span class="badge bg-success">Completed</span>',
            'cancelled' => '<span class="badge bg-danger">Cancelled</span>',
            default => '<span class="badge bg-secondary">Unknown</span>',
        };
    }
    
    public function getStatusColorAttribute(): string
    {
        return match($this->qr_status) {
            'pending' => 'warning',
            'contacted' => 'info',
            'completed' => 'success',
            'cancelled' => 'danger',
            default => 'secondary',
        };
    }
    
    public function getAttachmentUrlAttribute(): ?string
    {
        if ($this->qr_attachment) {
            $path = public_path('uploads/quote-attachments/' . $this->qr_attachment);
            if (file_exists($path)) {
                return asset('uploads/quote-attachments/' . $this->qr_attachment);
            }
        }
        return null;
    }
    
    public function getShortDetailsAttribute($length = 100): string
    {
        return Str::limit(strip_tags($this->qr_details ?? ''), $length);
    }
    
    public function getFullLocationAttribute(): string
    {
        return $this->qr_location ?: 'Not specified';
    }
    
    public function getFormattedBudgetAttribute(): string
    {
        return $this->qr_budget ?: 'Not specified';
    }
    
    // Static Methods
    public static function getTotalQuotes(): int
    {
        return self::count();
    }
    
    public static function getPendingQuotes(): int
    {
        return self::pending()->count();
    }
    
    public static function getTodayQuotes(): int
    {
        return self::today()->count();
    }
    
    public static function getCompletedQuotes(): int
    {
        return self::completed()->count();
    }
    
    public static function getServiceTypes(): array
    {
        return self::distinct()->pluck('qr_service_type')->filter()->toArray();
    }
    
    public static function getLocations(): array
    {
        return self::distinct()->pluck('qr_location')->filter()->toArray();
    }
}