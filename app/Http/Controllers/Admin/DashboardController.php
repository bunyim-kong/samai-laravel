<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\AreaImage;
use App\Models\CountrySide;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $countrySideCount = CountrySide::count();
        $areaCount = Area::count();
        $imageCount = AreaImage::count();

        $latestAreas = Area::query()
            ->with('countrySide')
            ->latest()
            ->take(5)
            ->get();

        $countrySides = CountrySide::query()
            ->withCount('areas')
            ->orderBy('name')
            ->get();

        return view('admin.dashboard', compact(
            'countrySideCount',
            'areaCount',
            'imageCount',
            'latestAreas',
            'countrySides'
        ));
    }
}