<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OurTeam extends Model
{
    use HasFactory;

    protected $table = 'our_team';
    protected $primaryKey = 'id'; // Fixed: Using 'id' as per migration

    protected $fillable = [
        'ot_name',
        'ot_image',
        'ot_designation',
        'ot_phone',
        'ot_email',
        'ot_fb',
        'ot_gm',
        'ot_inst',
        'ot_twitter',
        'ot_linkedin',
        'ot_description',
        'ot_experience',
        'ot_skills',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'ot_experience' => 'integer',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ============================================
    // SCOPES
    // ============================================
    
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'ASC')
                     ->orderBy('ot_name', 'ASC');
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }

    public function scopeExperienced($query)
    {
        return $query->where('ot_experience', '>', 5);
    }

    // ============================================
    // ACCESSORS
    // ============================================
    
    public function getImageUrlAttribute(): string
    {
        if ($this->ot_image) {
           if (file_exists(storage_path('app/public/'.$this->ot_image))) {
            return asset('storage/'.$this->ot_image);
           }
        }
        
        // Default avatar
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->ot_name) . '&background=0056b3&color=fff&size=300';
    }

    public function getSocialLinksAttribute(): array
    {
        return array_filter([
            'facebook' => $this->ot_fb,
            'instagram' => $this->ot_inst,
            'twitter' => $this->ot_twitter,
            'linkedin' => $this->ot_linkedin,
            'email' => $this->ot_email ? 'mailto:' . $this->ot_email : null,
            'phone' => $this->ot_phone ? 'tel:' . $this->ot_phone : null,
        ]);
    }

    public function getSkillsListAttribute(): array
    {
        if (empty($this->ot_skills)) {
            return [];
        }
        
        if (is_string($this->ot_skills)) {
            $decoded = json_decode($this->ot_skills, true);
            return is_array($decoded) ? $decoded : explode(',', $this->ot_skills);
        }
        
        return is_array($this->ot_skills) ? $this->ot_skills : [];
    }

    public function getExperienceYearsAttribute(): string
    {
        if (!$this->ot_experience) {
            return 'Fresher';
        }
        return $this->ot_experience . ' ' . ($this->ot_experience > 1 ? 'Years' : 'Year');
    }

    public function getShortBioAttribute($length = 100): string
    {
        return \Illuminate\Support\Str::limit(strip_tags($this->ot_description ?? ''), $length);
    }

    // ============================================
    // HELPER METHODS
    // ============================================
    
    public function hasImage(): bool
    {
        return !empty($this->ot_image);
    }

    public function hasSocialLinks(): bool
    {
        return !empty($this->ot_fb) || 
               !empty($this->ot_inst) || 
               !empty($this->ot_twitter) || 
               !empty($this->ot_linkedin);
    }

    public function isSeniorMember(): bool
    {
        return $this->ot_experience && $this->ot_experience >= 10;
    }

    // ============================================
    // STATIC METHODS
    // ============================================
    
    public static function getTotalMembers(): int
    {
        return self::active()->count();
    }

    public static function getAverageExperience(): float
    {
        return round(self::active()->avg('ot_experience') ?? 0, 1);
    }

    // ============================================
    // BOOT
    // ============================================
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($member) {
            if (empty($member->sort_order)) {
                $member->sort_order = self::max('sort_order') + 1;
            }
        });
        
        static::saving(function ($member) {
            // Convert skills array to JSON string if needed
            if (is_array($member->ot_skills)) {
                $member->ot_skills = json_encode(array_values(array_filter($member->ot_skills)));
            }
        });
    }
}