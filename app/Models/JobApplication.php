<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    use HasFactory;

    protected $table = 'job_applications';

    protected $fillable = [
        'career_id',
        'name',
        'email',
        'phone',
        'cover_letter',
        'resume_path',
        'status',
        'admin_notes',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ============================================
    // RELATIONSHIPS
    // ============================================

    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }

    // ============================================
    // SCOPES
    // ============================================

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeReviewed($query)
    {
        return $query->where('status', 'reviewed');
    }

    public function scopeShortlisted($query)
    {
        return $query->where('status', 'shortlisted');
    }

    public function scopeHired($query)
    {
        return $query->where('status', 'hired');
    }

    // ============================================
    // ACCESSORS
    // ============================================

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'new' => '<span class="badge bg-info">New</span>',
            'reviewed' => '<span class="badge bg-primary">Reviewed</span>',
            'shortlisted' => '<span class="badge bg-warning">Shortlisted</span>',
            'interviewed' => '<span class="badge bg-purple">Interviewed</span>',
            'hired' => '<span class="badge bg-success">Hired</span>',
            'rejected' => '<span class="badge bg-danger">Rejected</span>',
            default => '<span class="badge bg-secondary">Unknown</span>',
        };
    }

    public function getResumeUrlAttribute(): string
    {
        if ($this->resume_path) {
            return asset('storage/' . $this->resume_path);
        }
        return '';
    }
}