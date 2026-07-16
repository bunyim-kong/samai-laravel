<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Models\Area;
use App\Models\CountrySide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Throwable;

class AreaController extends Controller
{
    public function index(): View
    {
        $areas = Area::query()
            ->with([
                'countrySide',
                'images',
            ])
            ->latest()
            ->paginate(10);

        return view('admin.areas.index', compact('areas'));
    }

    public function create(): View
    {
        $countrySides = CountrySide::query()
            ->orderBy('name')
            ->get();

        return view('admin.areas.create', compact('countrySides'));
    }

    public function store(AreaRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            DB::transaction(function () use ($request, $validated) {
                $areaData = $validated;

                unset(
                    $areaData['photos'],
                    $areaData['remove_photos']
                );

                $areaData['is_active'] = $request->boolean('is_active');

                $area = Area::create($areaData);

                foreach ($request->file('photos', []) as $index => $photo) {
                    if (!$photo) {
                        continue;
                    }

                    $path = $photo->store(
                        'areas/photos',
                        'public'
                    );

                    $area->images()->create([
                        'image_path' => $path,
                        'sort_order' => (int) $index,
                    ]);
                }
            });

            return redirect()
                ->route('admin.areas.index')
                ->with('success', 'Area created successfully.');
        } catch (Throwable $exception) {
            report($exception);

            return back()
                ->withInput()
                ->withErrors([
                    'error' => $exception->getMessage(),
                ]);
        }
    }

    public function show(Area $area): View
    {
        $area->load([
            'countrySide',
            'images',
        ]);

        return view('admin.areas.show', compact('area'));
    }

    public function edit(Area $area): View
    {
        $area->load('images');

        $countrySides = CountrySide::query()
            ->orderBy('name')
            ->get();

        return view('admin.areas.edit', compact(
            'area',
            'countrySides'
        ));
    }

    public function update(
        AreaRequest $request,
        Area $area
    ): RedirectResponse {
        $validated = $request->validated();

        try {
            DB::transaction(function () use (
                $request,
                $validated,
                $area
            ) {
                $areaData = $validated;

                unset(
                    $areaData['photos'],
                    $areaData['remove_photos']
                );

                $areaData['is_active'] = $request->boolean('is_active');

                $area->update($areaData);

                $removePhotoIds = $request->input(
                    'remove_photos',
                    []
                );

                if (!empty($removePhotoIds)) {
                    $imagesToRemove = $area->images()
                        ->whereIn('id', $removePhotoIds)
                        ->get();

                    foreach ($imagesToRemove as $image) {
                        Storage::disk('public')->delete(
                            $image->image_path
                        );

                        $image->delete();
                    }
                }

                foreach ($request->file('photos', []) as $index => $photo) {
                    if (!$photo) {
                        continue;
                    }

                    $existingImage = $area->images()
                        ->where('sort_order', (int) $index)
                        ->first();

                    $path = $photo->store(
                        'areas/photos',
                        'public'
                    );

                    if ($existingImage) {
                        Storage::disk('public')->delete(
                            $existingImage->image_path
                        );

                        $existingImage->update([
                            'image_path' => $path,
                        ]);
                    } else {
                        $area->images()->create([
                            'image_path' => $path,
                            'sort_order' => (int) $index,
                        ]);
                    }
                }
            });

            return redirect()
                ->route('admin.areas.index')
                ->with('success', 'Area updated successfully.');
        } catch (Throwable $exception) {
            report($exception);

            return back()
                ->withInput()
                ->withErrors([
                    'error' => $exception->getMessage(),
                ]);
        }
    }

    public function destroy(Area $area): RedirectResponse
    {
        try {
            DB::transaction(function () use ($area) {
                $area->load('images');

                foreach ($area->images as $image) {
                    Storage::disk('public')->delete(
                        $image->image_path
                    );
                }

                if ($area->image) {
                    Storage::disk('public')->delete(
                        $area->image
                    );
                }

                $area->delete();
            });

            return redirect()
                ->route('admin.areas.index')
                ->with('success', 'Area deleted successfully.');
        } catch (Throwable $exception) {
            report($exception);

            return back()->withErrors([
                'error' => $exception->getMessage(),
            ]);
        }
    }
}