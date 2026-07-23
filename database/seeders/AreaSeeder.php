<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\CountrySide;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JsonException;
use RuntimeException;

class AreaSeeder extends Seeder
{
    /**
     * @throws JsonException
     */
    public function run(): void
    {
        $areas = $this->areaData();

        DB::transaction(function () use ($areas): void {
            $countrySideIds = CountrySide::query()
                ->pluck('id', 'slug');

            foreach ($areas as $attributes) {
                $countrySideSlug = $attributes['country_side_slug'];
                $imagePaths = $attributes['images'];

                unset(
                    $attributes['country_side_slug'],
                    $attributes['images']
                );

                $countrySideId = $countrySideIds->get($countrySideSlug);

                if ($countrySideId === null) {
                    throw new RuntimeException(
                        "Country side [{$countrySideSlug}] must be seeded before its areas."
                    );
                }

                $attributes['country_side_id'] = $countrySideId;

                $area = Area::query()->updateOrCreate(
                    ['slug' => $attributes['slug']],
                    $attributes
                );

                if ($imagePaths === []) {
                    $area->images()->delete();

                    continue;
                }

                $area->images()
                    ->whereNotIn('image_path', $imagePaths)
                    ->delete();

                foreach ($imagePaths as $sortOrder => $imagePath) {
                    $area->images()->updateOrCreate(
                        ['image_path' => $imagePath],
                        ['sort_order' => $sortOrder]
                    );
                }
            }
        });
    }

    /**
     * @return array<int, array<string, mixed>>
     *
     * @throws JsonException
     */
    private function areaData(): array
    {
        $path = database_path('seeders/data/areas.json');
        $json = file_get_contents($path);

        if ($json === false) {
            throw new RuntimeException(
                "Unable to read area seed data from [{$path}]."
            );
        }

        return json_decode(
            $json,
            true,
            flags: JSON_THROW_ON_ERROR
        );
    }
}
