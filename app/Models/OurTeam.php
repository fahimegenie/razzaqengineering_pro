<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OurTeam extends Model
{
    use HasFactory;

    protected $table = 'our_team';
    protected $primaryKey = 'ot_id';

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

    protected function casts(): array
    {
        return [
            'ot_experience' => 'integer',
            'ot_skills' => 'array',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

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

    // ============================================
    // ACCESSORS
    // ============================================
    
    public function getImageUrlAttribute(): string
    {
        if ($this->ot_image) {
            if (file_exists(public_path('public/ot_image/' . $this->ot_image))) {
                return asset('public/ot_image/' . $this->ot_image);
            }
            if (file_exists(public_path('uploads/team/' . $this->ot_image))) {
                return asset('uploads/team/' . $this->ot_image);
            }
        }
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
        $skills = $this->ot_skills;
        if (is_string($skills)) {
            return json_decode($skills, true) ?? [];
        }
        return is_array($skills) ? $skills : [];
    }
}