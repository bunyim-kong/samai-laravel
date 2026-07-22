<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CountrySide extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'center_lat',
        'center_lng',
        'zoom',
        'position_top',
        'position_left',
        'label_position',
    ];

    protected $casts = [
        'center_lat' => 'decimal:7',
        'center_lng' => 'decimal:7',
        'zoom' => 'integer',
        'position_top' => 'decimal:2',
        'position_left' => 'decimal:2',
    ];

    public function areas(): HasMany
    {
        return $this->hasMany(Area::class)
            ->orderBy('title');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
