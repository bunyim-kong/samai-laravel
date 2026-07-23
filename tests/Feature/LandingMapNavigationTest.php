<?php

namespace Tests\Feature;

use Illuminate\Http\Request;
use Tests\TestCase;

class LandingMapNavigationTest extends TestCase
{
    public function test_closing_the_all_locations_map_returns_to_landing(): void
    {
        $html = $this->renderLandingForRoute('map.all');

        $this->assertStringContainsString(
            'const isAllMapRoute = true;',
            $html
        );
        $this->assertStringContainsString(
            'window.location.replace(landingUrl);',
            $html
        );
    }

    public function test_landing_page_keeps_the_normal_map_modal_behavior(): void
    {
        $html = $this->renderLandingForRoute('landing');

        $this->assertStringContainsString(
            'const isAllMapRoute = false;',
            $html
        );
    }

    private function renderLandingForRoute(string $routeName): string
    {
        $request = Request::create(route($routeName, absolute: false));
        $route = app('router')->getRoutes()->getByName($routeName);

        $request->setRouteResolver(fn () => $route);

        app()->instance('request', $request);

        return view('landing', [
            'countrySides' => collect(),
        ])->render();
    }
}
