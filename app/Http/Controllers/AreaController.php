<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class AreaController extends Controller
{
    public function show(Area $area): View
    {
        $area->load([
            'countrySide',
            'images',
        ]);

        return view(
            'components.venue-card',
            compact('area')
        );
    }

    public function data(Area $area): JsonResponse
    {
        $area->load([
            'countrySide',
            'images',
        ]);

        return response()->json([
            'id' => $area->id,
            'title' => $area->title,

            'province' => [
                'id' => $area->countrySide?->id,
                'name' => $area->countrySide?->name,
                'slug' => $area->countrySide?->slug,
            ],

            'lat' => $area->lat !== null
                ? (float) $area->lat
                : null,

            'lng' => $area->lng !== null
                ? (float) $area->lng
                : null,

            'address' => $area->address,
            'open_hours' => $area->open_hours,
            'description' => $area->description,
            'serves' => $area->serves,
            'phone' => $area->phone,
            'email' => $area->email,
            'facebook' => $area->facebook,
            'instagram' => $area->instagram,
            'maps_url' => $area->maps_url,

            'images' => $area->images
                ->map(function ($image) {
                    return [
                        'id' => $image->id,
                        'image_path' => $image->image_path,
                        'image_url' => $image->image_url,
                        'sort_order' => $image->sort_order,
                    ];
                })
                ->values(),
        ]);
    }
}