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
            ->with('countrySide')
            ->latest()
            ->paginate(10);

        return view('admin.areas.index', compact('areas'));
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

    public function store(AreaRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            DB::transaction(function () use ($request, $validated) {
                if ($request->hasFile('image')) {
                    $validated['image'] = $request
                        ->file('image')
                        ->store('areas/main', 'public');
                }

                unset($validated['gallery']);

                $area = Area::create($validated);

                if ($request->hasFile('gallery')) {
                    foreach ($request->file('gallery') as $index => $file) {
                        $path = $file->store(
                            'areas/gallery',
                            'public'
                        );

                        $area->images()->create([
                            'image_path' => $path,
                            'sort_order' => $index,
                        ]);
                    }
                }
            });
        } catch (Throwable $exception) {
            report($exception);

            return back()
                ->withInput()
                ->withErrors([
                    'error' => 'The area could not be created.',
                ]);
        }

        return redirect()
            ->route('admin.areas.index')
            ->with('success', 'Area created successfully.');
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

        return view(
            'admin.areas.edit',
            compact('area', 'countrySides')
        );
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
                if ($request->hasFile('image')) {
                    if ($area->image) {
                        Storage::disk('public')
                            ->delete($area->image);
                    }

                    $validated['image'] = $request
                        ->file('image')
                        ->store('areas/main', 'public');
                }

                unset($validated['gallery']);

                $area->update($validated);

                if ($request->hasFile('gallery')) {
                    foreach ($request->file('gallery') as $index => $file) {
                        $path = $file->store(
                            'areas/gallery',
                            'public'
                        );

                        $area->images()->create([
                            'image_path' => $path,
                            'sort_order' => $area->images()->count() + $index,
                        ]);
                    }
                }
            });
        } catch (Throwable $exception) {
            report($exception);

            return back()
                ->withInput()
                ->withErrors([
                    'error' => 'The area could not be updated.',
                ]);
        }

        return redirect()
            ->route('admin.areas.index')
            ->with('success', 'Area updated successfully.');
    }

    public function destroy(Area $area): RedirectResponse
    {
        try {
            DB::transaction(function () use ($area) {
                if ($area->image) {
                    Storage::disk('public')
                        ->delete($area->image);
                }

                foreach ($area->images as $image) {
                    Storage::disk('public')
                        ->delete($image->image_path);
                }

                $area->delete();
            });
        } catch (Throwable $exception) {
            report($exception);

            return back()->withErrors([
                'error' => 'The area could not be deleted.',
            ]);
        }

        return redirect()
            ->route('admin.areas.index')
            ->with('success', 'Area deleted successfully.');
    }
}