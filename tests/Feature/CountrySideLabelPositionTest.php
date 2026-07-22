<?php

namespace Tests\Feature;

use App\Http\Requests\CountrySideRequest;
use App\Models\CountrySide;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class CountrySideLabelPositionTest extends TestCase
{
    public function test_a_province_label_uses_its_selected_position(): void
    {
        $countrySide = new CountrySide([
            'name' => 'Kep',
            'slug' => 'kep',
            'center_lat' => 10.4829,
            'center_lng' => 104.3167,
            'zoom' => 12,
            'position_top' => 88,
            'position_left' => 42,
            'label_position' => 'right',
        ]);

        $html = view('landing', [
            'countrySides' => collect([$countrySide]),
        ])->render();

        $this->assertStringContainsString(
            'province-label-right',
            $html
        );
        $this->assertStringContainsString('Kep', $html);
        $this->assertContains(
            'label_position',
            $countrySide->getFillable()
        );
    }

    public function test_label_position_must_be_a_supported_direction(): void
    {
        $request = CountrySideRequest::create(
            '/admin/country-sides',
            'POST'
        );
        $rules = $request->rules();

        $this->assertTrue(Validator::make(
            ['label_position' => 'left'],
            ['label_position' => $rules['label_position']]
        )->passes());

        $this->assertFalse(Validator::make(
            ['label_position' => 'diagonal'],
            ['label_position' => $rules['label_position']]
        )->passes());
    }
}
