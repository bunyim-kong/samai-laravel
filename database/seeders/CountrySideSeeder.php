<?php

namespace Database\Seeders;

use App\Models\CountrySide;
use Illuminate\Database\Seeder;

class CountrySideSeeder extends Seeder
{
    public function run(): void
    {
        $countrySides = [
            [
                'name' => 'Siem Reap',
                'slug' => 'siem-reap',
                'center_lat' => 13.3633,
                'center_lng' => 103.8564,
                'zoom' => 12,
                'position_top' => 32,
                'position_left' => 30,
            ],
            [
                'name' => 'Battambang',
                'slug' => 'battambang',
                'center_lat' => 13.0957,
                'center_lng' => 103.2022,
                'zoom' => 12,
                'position_top' => 44,
                'position_left' => 16,
            ],
            [
                'name' => 'Phnom Penh',
                'slug' => 'phnom-penh',
                'center_lat' => 11.5564,
                'center_lng' => 104.9282,
                'zoom' => 12,
                'position_top' => 61,
                'position_left' => 49,
            ],
            [
                'name' => 'Koh Rong',
                'slug' => 'koh-rong',
                'center_lat' => 10.6359,
                'center_lng' => 103.5000,
                'zoom' => 12,
                'position_top' => 82,
                'position_left' => 15,
            ],
            [
                'name' => 'Kampot',
                'slug' => 'kampot',
                'center_lat' => 10.6104,
                'center_lng' => 104.1814,
                'zoom' => 12,
                'position_top' => 91,
                'position_left' => 38,
            ],
            [
                'name' => 'Sihanoukville',
                'slug' => 'sihanoukville',
                'center_lat' => 10.6273,
                'center_lng' => 103.5220,
                'zoom' => 12,
                'position_top' => 96,
                'position_left' => 24,
            ],
        ];

        foreach ($countrySides as $countrySide) {
            CountrySide::updateOrCreate(
                ['slug' => $countrySide['slug']],
                $countrySide
            );
        }
    }
}