<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class AreaImage extends Model
{
    protected $table = 'area_images';

    protected $fillable = [
        'area_id',
        'image_path',
        'sort_order',
    ];

    protected $casts = [
        'area_id' => 'integer',
        'sort_order' => 'integer',
    ];

    protected $appends = [
        'image_url',
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image_path) {
            return null;
        }

        $path = trim($this->image_path);

        if (
            Str::startsWith($path, 'http://') ||
            Str::startsWith($path, 'https://')
        ) {
            return $path;
        }

        $path = ltrim($path, '/');

        if (Str::startsWith($path, 'public/')) {
            $path = Str::after($path, 'public/');
        }

        if (Str::startsWith($path, 'storage/')) {
            $path = Str::after($path, 'storage/');
        }

        return '/storage/' . $path;
    }
}