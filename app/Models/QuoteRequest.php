<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    
    // Accessors
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-warning',
            'contacted' => 'bg-info',
            'completed' => 'bg-success',
            'cancelled' => 'bg-danger',
        ];
        
        return $badges[$this->qr_status] ?? 'bg-secondary';
    }
    
    public function getAttachmentUrlAttribute()
    {
        return $this->qr_attachment 
            ? asset('storage/'.$this->qr_attachment) 
            : null;
    }
}