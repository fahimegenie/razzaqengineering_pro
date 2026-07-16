<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceAdvantage extends Model
{
    use HasFactory;

    protected $table = 'service_advantage';

    protected $fillable = [
        'sa_st_id',
        'sa_title',
        'sa_description',
        'sa_image',
        'sa_t1',
        'sa_t2',
        'sa_t3',
        'sa_t4',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function serviceDetail(): BelongsTo
    {
        return $this->belongsTo(ServiceDetail::class, 'sa_st_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'sa_st_id', 'id');
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->sa_image) {
            if (file_exists(storage_path('app/public/'.$this->sa_image))){
                return asset('storage/'.$this->sa_image);
            }
        }
        return asset('images/placeholder-advantage.jpg');
    }

    public function getBulletPointsAttribute(): array
    {
        return array_filter([$this->sa_t1, $this->sa_t2, $this->sa_t3, $this->sa_t4]);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'ASC');
    }
}