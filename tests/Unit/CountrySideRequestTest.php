<?php

namespace Tests\Unit;

use App\Http\Requests\CountrySideRequest;
use App\Models\CountrySide;
use PHPUnit\Framework\TestCase;

class CountrySideRequestTest extends TestCase
{
    public function test_slug_unique_rule_ignores_bound_country_side(): void
    {
        $countrySide = new CountrySide;
        $countrySide->id = 123;

        $request = CountrySideRequest::create(
            '/admin/country-sides/phnom-penh',
            'PUT'
        );

        $request->setRouteResolver(function () use ($countrySide) {
            return new class($countrySide)
            {
                public function __construct(
                    private CountrySide $countrySide
                ) {}

                public function parameter(string $key): ?CountrySide
                {
                    return match ($key) {
                        'country_side' => $this->countrySide,
                        default => null,
                    };
                }
            };
        });

        $slugRules = $request->rules()['slug'];
        $uniqueRule = end($slugRules);

        $this->assertSame(
            'unique:country_sides,slug,"123",id',
            (string) $uniqueRule
        );
    }
}
