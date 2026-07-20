<?php

namespace App\Http\Controllers;

use App\Models\CountrySide;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class MapController extends Controller
{
    public function show(CountrySide $countrySide): View
    {
        $countrySide->load([
            'areas' => function ($query) {
                $query
                    ->whereNotNull('lat')
                    ->whereNotNull('lng')
                    ->with('images')
                    ->orderBy('title');
            },
        ]);

        return view('interactive-map', compact('countrySide'));
    }

    public function data(CountrySide $countrySide): JsonResponse
    {
        $countrySide->load([
            'areas' => function ($query) {
                $query
                    ->whereNotNull('lat')
                    ->whereNotNull('lng')
                    ->with('images')
                    ->orderBy('title');
            },
        ]);

        return response()->json([
            'province' => [
                'id' => $countrySide->id,
                'name' => $countrySide->name,
                'slug' => $countrySide->slug,
                'center' => [
                    $countrySide->center_lat !== null
                        ? (float) $countrySide->center_lat
                        : 11.5564,

                    $countrySide->center_lng !== null
                        ? (float) $countrySide->center_lng
                        : 104.9282,
                ],
                'zoom' => $countrySide->zoom ?? 10,
            ],

            'markers' => $countrySide->areas->map(function ($area) {
                return [
                    'id' => $area->id,
                    'title' => $area->title,
                    'lat' => (float) $area->lat,
                    'lng' => (float) $area->lng,
                    'is_recommended' => (bool) $area->is_recommended,
                    'image_url' => $area->image_url,
                ];
            })->values(),
        ]);
    }
}
