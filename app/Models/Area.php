<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Area extends Model
{
    protected $fillable = [
        'country_side_id',
        'title',
        'slug',
        'lat',
        'lng',
        'google_map_url',
        'image',
        'address',
        'open_hours',
        'description',
        'serves',
        'phone',
        'email',
        'facebook',
        'instagram',
        'is_active',
    ];

    protected $casts = [
        'country_side_id' => 'integer',
        'lat' => 'decimal:7',
        'lng' => 'decimal:7',
        'is_active' => 'boolean',
    ];

    protected $appends = [
        'image_url',
        'maps_url',
    ];

    public function countrySide(): BelongsTo
    {
        return $this->belongsTo(CountrySide::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(AreaImage::class)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
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
                ->where('title', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('serves', 'like', "%{$search}%");
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        if (
            str_starts_with($this->image, 'http://') ||
            str_starts_with($this->image, 'https://')
        ) {
            return $this->image;
        }

        return Storage::disk('public')->url($this->image);
    }

    public function getMapsUrlAttribute(): ?string
    {
        if ($this->google_map_url) {
            return $this->google_map_url;
        }

        if ($this->lat === null || $this->lng === null) {
            return null;
        }

        return sprintf(
            'https://www.google.com/maps/search/?api=1&query=%s,%s',
            $this->lat,
            $this->lng
        );
    }
}