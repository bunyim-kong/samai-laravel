<?php

namespace App\Http\Controllers;

use App\Models\CountrySide;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function welcome(): View
    {
        return view('welcome');
    }

    public function landing(): View
    {
        $countrySides = CountrySide::query()
            ->orderBy('name')
            ->get();

        return view('landing', compact('countrySides'));
    }
}