<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable([
    'ca_address',
    'ca_email',
    'ca_phone',
    'footer_phone',
    'whatsapp',
    'office_hours',
    'google_map',
    'facebook',
    'instagram',
    'linkedin',
    'youtube'
])]
class ContactAddress extends Model
{
    use HasFactory;

    protected $table = 'contact_address';

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function getFormattedPhoneAttribute(): string
    {
        return $this->ca_phone ? '+92 ' . substr($this->ca_phone, 0, 3) . ' ' . substr($this->ca_phone, 3, 7) : '';
    }

    public function getWhatsappLinkAttribute(): string
    {
        return $this->whatsapp 
            ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $this->whatsapp) 
            : '#';
    }
}