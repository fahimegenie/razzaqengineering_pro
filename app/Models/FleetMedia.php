<?php
// app/Models/FleetMedia.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'fleet_item_id',
        'file_path',
        'file_type',
        'title',
        'sort_order',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function fleetItem()
    {
        return $this->belongsTo(FleetItem::class);
    }
}