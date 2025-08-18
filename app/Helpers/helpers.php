<?php


if (!function_exists('randomCoordinatesAround')) {
    function randomCoordinatesAround($lat, $lng, $minKm = 1, $maxKm = 12)
    {
        $earthRadius = 6371; // km

        $distance = mt_rand($minKm * 1000, $maxKm * 1000) / 1000;
        $bearing = deg2rad(mt_rand(0, 360));

        $latRad = deg2rad($lat);
        $lngRad = deg2rad($lng);

        $newLat = asin(
            sin($latRad) * cos($distance / $earthRadius) +
            cos($latRad) * sin($distance / $earthRadius) * cos($bearing)
        );

        $newLng = $lngRad + atan2(
                sin($bearing) * sin($distance / $earthRadius) * cos($latRad),
                cos($distance / $earthRadius) - sin($latRad) * sin($newLat)
            );

        return [
            'latitude' => rad2deg($newLat),
            'longitude' => rad2deg($newLng),
        ];
    }
}
