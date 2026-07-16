<?php

namespace Tests\Unit;

use App\Support\GoogleMapsUrlParser;
use PHPUnit\Framework\TestCase;

class GoogleMapsUrlParserTest extends TestCase
{
    public function test_it_extracts_coordinates_from_google_maps_at_url(): void
    {
        $coordinates = GoogleMapsUrlParser::coordinatesFromUrl(
            'https://www.google.com/maps/place/Samai/@11.5564,104.9282,17z'
        );

        $this->assertSame(
            [
                'lat' => '11.5564000',
                'lng' => '104.9282000',
            ],
            $coordinates
        );
    }

    public function test_it_extracts_coordinates_from_google_maps_place_tokens(): void
    {
        $coordinates = GoogleMapsUrlParser::coordinatesFromUrl(
            'https://www.google.com/maps/place/Samai/data=!3d11.5564!4d104.9282'
        );

        $this->assertSame(
            [
                'lat' => '11.5564000',
                'lng' => '104.9282000',
            ],
            $coordinates
        );
    }

    public function test_it_extracts_coordinates_from_query_parameter(): void
    {
        $coordinates = GoogleMapsUrlParser::coordinatesFromUrl(
            'https://www.google.com/maps/search/?api=1&query=11.5564,104.9282'
        );

        $this->assertSame(
            [
                'lat' => '11.5564000',
                'lng' => '104.9282000',
            ],
            $coordinates
        );
    }

    public function test_it_ignores_urls_without_coordinates(): void
    {
        $this->assertNull(
            GoogleMapsUrlParser::coordinatesFromUrl(
                'https://maps.app.goo.gl/example'
            )
        );
    }
}
