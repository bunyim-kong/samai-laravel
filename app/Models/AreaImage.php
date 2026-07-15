<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class AreaImage extends Model
{

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

        if (
            str_starts_with($this->image_path, 'http://') ||
            str_starts_with($this->image_path, 'https://')
        ) {
            return $this->image_path;
        }

        return Storage::disk('public')->url($this->image_path);
    }
}