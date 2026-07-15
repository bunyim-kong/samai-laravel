<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public function activeAreas(): HasMany
    {
        return $this->hasMany(Area::class)
            ->where('is_active', true)
            ->orderBy('title');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeSearch(
        Builder $query,
        ?string $search
    ): Builder {
        $search = trim((string) $search);

        if ($search === '') {
            return $query;
        }

        return $query->where(function (Builder $builder) use ($search): void {
            $builder
                ->where('name', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%");
        });
    }
}