<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountrySideRequest;
use App\Models\CountrySide;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CountrySideController extends Controller
{
    public function index(): View
    {
        $countrySides = CountrySide::query()
            ->withCount('areas')
            ->orderBy('name')
            ->paginate(10);

        return view('admin.country-sides.index', compact('countrySides'));
    }

    public function create(): View
    {
        return view('admin.country-sides.create');
    }

    public function store(CountrySideRequest $request): RedirectResponse
    {
        CountrySide::create($request->validated());

        return redirect()
            ->route('admin.country-sides.index')
            ->with('success', 'Province created successfully.');
    }

    public function show(CountrySide $countrySide): View
    {
        $countrySide->load('areas.images');

        return view(
            'admin.country-sides.show',
            compact('countrySide')
        );
    }

    public function edit(CountrySide $countrySide): View
    {
        return view(
            'admin.country-sides.edit',
            compact('countrySide')
        );
    }

    public function update(
        CountrySideRequest $request,
        CountrySide $countrySide
    ): RedirectResponse {
        $countrySide->update($request->validated());

        return redirect()
            ->route('admin.country-sides.index')
            ->with('success', 'Province updated successfully.');
    }

    public function destroy(
        CountrySide $countrySide
    ): RedirectResponse {
        $countrySide->delete();

        return redirect()
            ->route('admin.country-sides.index')
            ->with('success', 'Province deleted successfully.');
    }
}