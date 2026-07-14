<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ContactMessage extends Model
{
    use SoftDeletes;

    protected $table = 'contact_messages';

    protected $fillable = [
        'cm_name',
        'cm_email',
        'cm_phone',
        'cm_subject',
        'cm_message',
        'cm_company',
        'cm_city',
        'service_id',
        'cm_source',
        'cm_priority',
        'cm_status',
        'cm_notes',
        'assigned_to',
        'follow_up_date',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'follow_up_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Relationships
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }

    // Scopes
    public function scopeNew($query)
    {
        return $query->where('cm_status', 'new');
    }

    public function scopeRead($query)
    {
        return $query->where('cm_status', 'read');
    }

    public function scopeContacted($query)
    {
        return $query->where('cm_status', 'contacted');
    }

    public function scopeResolved($query)
    {
        return $query->where('cm_status', 'resolved');
    }

    public function scopeClosed($query)
    {
        return $query->where('cm_status', 'closed');
    }

    public function scopeUnread($query)
    {
        return $query->whereIn('cm_status', ['new']);
    }

    public function scopeHighPriority($query)
    {
        return $query->whereIn('cm_priority', ['high', 'urgent']);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }

    public function scopeBySource($query, $source)
    {
        return $query->where('cm_source', $source);
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('cm_priority', $priority);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('cm_status', $status);
    }

    public function scopeByCity($query, $city)
    {
        return $query->where('cm_city', 'like', "%{$city}%");
    }

    // Accessors
    public function getStatusBadgeAttribute(): string
    {
        return match($this->cm_status) {
            'new' => '<span class="badge bg-danger">New</span>',
            'read' => '<span class="badge bg-info">Read</span>',
            'contacted' => '<span class="badge bg-primary">Contacted</span>',
            'resolved' => '<span class="badge bg-success">Resolved</span>',
            'closed' => '<span class="badge bg-secondary">Closed</span>',
            default => '<span class="badge bg-light text-dark">Unknown</span>',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->cm_status) {
            'new' => 'danger',
            'read' => 'info',
            'contacted' => 'primary',
            'resolved' => 'success',
            'closed' => 'secondary',
            default => 'light',
        };
    }

    public function getPriorityBadgeAttribute(): string
    {
        return match($this->cm_priority) {
            'urgent' => '<span class="badge bg-danger"><i class="bi bi-exclamation-triangle-fill"></i> Urgent</span>',
            'high' => '<span class="badge bg-warning text-dark"><i class="bi bi-arrow-up-circle-fill"></i> High</span>',
            'medium' => '<span class="badge bg-info"><i class="bi bi-dash-circle-fill"></i> Medium</span>',
            'low' => '<span class="badge bg-secondary"><i class="bi bi-arrow-down-circle-fill"></i> Low</span>',
            default => '<span class="badge bg-light text-dark">Unknown</span>',
        };
    }

    public function getSourceBadgeAttribute(): string
    {
        return match($this->cm_source) {
            'website' => '<span class="badge bg-primary"><i class="bi bi-globe"></i> Website</span>',
            'phone' => '<span class="badge bg-success"><i class="bi bi-telephone"></i> Phone</span>',
            'email' => '<span class="badge bg-info"><i class="bi bi-envelope"></i> Email</span>',
            'social' => '<span class="badge bg-warning"><i class="bi bi-share"></i> Social</span>',
            'referral' => '<span class="badge bg-secondary"><i class="bi bi-people"></i> Referral</span>',
            'other' => '<span class="badge bg-dark"><i class="bi bi-three-dots"></i> Other</span>',
            default => '<span class="badge bg-light text-dark">Unknown</span>',
        };
    }

    public function getShortMessageAttribute($length = 100): string
    {
        return Str::limit(strip_tags($this->cm_message ?? ''), $length);
    }

    public function getFullLocationAttribute(): string
    {
        return $this->cm_city ?: 'Not specified';
    }

    public function getHasFollowUpAttribute(): bool
    {
        return $this->follow_up_date && $this->follow_up_date->isFuture();
    }

    public function getIsOverdueAttribute(): bool
    {
        return $this->follow_up_date && $this->follow_up_date->isPast() && !in_array($this->cm_status, ['resolved', 'closed']);
    }

    // Static Methods
    public static function getTotalMessages(): int
    {
        return self::count();
    }

    public static function getNewMessages(): int
    {
        return self::new()->count();
    }

    public static function getUnreadMessages(): int
    {
        return self::unread()->count();
    }

    public static function getTodayMessages(): int
    {
        return self::today()->count();
    }

    public static function getHighPriorityMessages(): int
    {
        return self::highPriority()->count();
    }

    public static function getResolvedMessages(): int
    {
        return self::resolved()->count();
    }

    public static function getStatusOptions(): array
    {
        return ['new', 'read', 'contacted', 'resolved', 'closed'];
    }

    public static function getPriorityOptions(): array
    {
        return ['low', 'medium', 'high', 'urgent'];
    }

    public static function getSourceOptions(): array
    {
        return ['website', 'phone', 'email', 'social', 'referral', 'other'];
    }

    public static function getCities(): array
    {
        return self::distinct()->whereNotNull('cm_city')->pluck('cm_city')->filter()->toArray();
    }

    public static function getSubjects(): array
    {
        return self::distinct()->whereNotNull('cm_subject')->pluck('cm_subject')->filter()->toArray();
    }
}