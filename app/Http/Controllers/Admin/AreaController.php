<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Models\Area;
use App\Models\CountrySide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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

        return view(
            'admin.areas.index',
            compact('areas')
        );
    }

    public function create(): View
    {
        $countrySides = CountrySide::query()
            ->orderBy('name')
            ->get();

        return view(
            'admin.areas.create',
            compact('countrySides')
        );
    }

    public function store(
        AreaRequest $request
    ): RedirectResponse {
        $validated = $request->validated();

        try {
            DB::transaction(
                function () use ($request, $validated): void {
                    $areaData = Arr::except(
                        $validated,
                        [
                            'photos',
                            'remove_photos',
                        ]
                    );

                    $areaData['is_active'] =
                        $request->boolean('is_active');

                    $areaData['is_recommended'] =
                        $request->boolean('is_recommended');

                    $area = Area::create($areaData);

                    foreach (
                        $request->file('photos', []) as $index => $photo
                    ) {
                        if (! $photo instanceof UploadedFile) {
                            continue;
                        }

                        $path = $this->storePhoto($photo);

                        $area->images()->create([
                            'image_path' => $path,
                            'sort_order' => (int) $index,
                        ]);
                    }
                }
            );

            return redirect()
                ->route('admin.areas.index')
                ->with(
                    'success',
                    'Area created successfully.'
                );
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

        return view(
            'admin.areas.show',
            compact('area')
        );
    }

    public function edit(Area $area): View
    {
        $area->load('images');

        $countrySides = CountrySide::query()
            ->orderBy('name')
            ->get();

        return view(
            'admin.areas.edit',
            compact(
                'area',
                'countrySides'
            )
        );
    }

    public function update(
        AreaRequest $request,
        Area $area
    ): RedirectResponse {
        $validated = $request->validated();

        try {
            DB::transaction(
                function () use (
                    $request,
                    $validated,
                    $area
                ): void {
                    $areaData = Arr::except(
                        $validated,
                        [
                            'photos',
                            'remove_photos',
                        ]
                    );

                    $areaData['is_active'] =
                        $request->boolean('is_active');

                    $areaData['is_recommended'] =
                        $request->boolean('is_recommended');

                    $area->update($areaData);

                    $removePhotoIds = $request->input(
                        'remove_photos',
                        []
                    );

                    $imagesToRemove = $area->images()
                        ->whereIn('id', $removePhotoIds)
                        ->get();

                    foreach ($imagesToRemove as $image) {
                        Storage::disk('uploads')->delete(
                            $image->image_path
                        );

                        $image->delete();
                    }

                    foreach (
                        $request->file('photos', []) as $index => $photo
                    ) {
                        if (! $photo instanceof UploadedFile) {
                            continue;
                        }

                        $sortOrder = (int) $index;

                        $existingImage = $area->images()
                            ->where(
                                'sort_order',
                                $sortOrder
                            )
                            ->first();

                        $newPath = $this->storePhoto($photo);

                        if ($existingImage) {
                            Storage::disk('uploads')->delete(
                                $existingImage->image_path
                            );

                            $existingImage->update([
                                'image_path' => $newPath,
                            ]);
                        } else {
                            $area->images()->create([
                                'image_path' => $newPath,
                                'sort_order' => $sortOrder,
                            ]);
                        }
                    }
                }
            );

            return redirect()
                ->route('admin.areas.index')
                ->with(
                    'success',
                    'Area updated successfully.'
                );
        } catch (Throwable $exception) {
            report($exception);

            return back()
                ->withInput()
                ->withErrors([
                    'error' => $exception->getMessage(),
                ]);
        }
    }

    public function destroy(
        Area $area
    ): RedirectResponse {
        try {
            DB::transaction(
                function () use ($area): void {
                    $area->load('images');

                    foreach ($area->images as $image) {
                        Storage::disk('uploads')->delete(
                            $image->image_path
                        );
                    }

                    $area->delete();
                }
            );

            return redirect()
                ->route('admin.areas.index')
                ->with(
                    'success',
                    'Area deleted successfully.'
                );
        } catch (Throwable $exception) {
            report($exception);

            return back()->withErrors([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    private function storePhoto(
        UploadedFile $photo
    ): string {
        $extension = strtolower(
            $photo->extension()
                ?: $photo->getClientOriginalExtension()
        );

        $filename = Str::uuid()->toString()
            .'.'
            .$extension;

        return $photo->storeAs(
            'areas/photos',
            $filename,
            'uploads'
        );
    }
}
