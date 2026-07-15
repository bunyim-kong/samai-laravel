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
        'lat',
        'lng',
        'title',
        'image',
        'address',
        'open_hours',
        'description',
        'serves',
        'phone',
        'email',
        'facebook',
        'instagram',
    ];

    protected $casts = [
        'country_side_id' => 'integer',
        'lat' => 'decimal:7',
        'lng' => 'decimal:7',
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

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        $search = trim((string) $search);

        if ($search === '') {
            return $query;
        }

        return $query->where(function (Builder $builder) use ($search) {
            $builder
                ->where('title', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('serves', 'like', "%{$search}%");
        });
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        return Storage::disk('public')->url($this->image);
    }

    public function getMapsUrlAttribute(): ?string
    {
        if ($this->lat === null || $this->lng === null) {
            return null;
        }

        return 'https://www.google.com/maps/search/?api=1&query='
            . $this->lat
            . ','
            . $this->lng;
    }
}