<?php

namespace App\Support;

class GoogleMapsUrlParser
{
    public static function coordinatesFromUrl(
        ?string $url
    ): ?array {
        $url = trim((string) $url);

        if ($url === '') {
            return null;
        }

        $patterns = [
            '/@(-?\d+(?:\.\d+)?),\s*(-?\d+(?:\.\d+)?)/',
            '/!3d(-?\d+(?:\.\d+)?)!4d(-?\d+(?:\.\d+)?)/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches) === 1) {
                return self::validCoordinates(
                    $matches[1],
                    $matches[2]
                );
            }
        }

        $query = parse_url($url, PHP_URL_QUERY);

        if (! is_string($query)) {
            return null;
        }

        parse_str($query, $params);

        foreach (['query', 'q', 'll'] as $key) {
            $coordinates = self::coordinatesFromText(
                $params[$key] ?? null
            );

            if ($coordinates !== null) {
                return $coordinates;
            }
        }

        return null;
    }

    private static function coordinatesFromText(
        mixed $value
    ): ?array {
        if (! is_string($value)) {
            return null;
        }

        if (
            preg_match(
                '/(-?\d+(?:\.\d+)?)\s*,\s*(-?\d+(?:\.\d+)?)/',
                $value,
                $matches
            ) !== 1
        ) {
            return null;
        }

        return self::validCoordinates(
            $matches[1],
            $matches[2]
        );
    }

    private static function validCoordinates(
        string $lat,
        string $lng
    ): ?array {
        $lat = (float) $lat;
        $lng = (float) $lng;

        if ($lat < -90 || $lat > 90) {
            return null;
        }

        if ($lng < -180 || $lng > 180) {
            return null;
        }

        return [
            'lat' => number_format($lat, 7, '.', ''),
            'lng' => number_format($lng, 7, '.', ''),
        ];
    }
}
