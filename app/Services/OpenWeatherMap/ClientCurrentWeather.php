<?php

namespace App\Services\OpenWeatherMap;

class ClientCurrentWeather extends AbstractClient
{
    public function getPath(): string
    {
        return '/data/2.5/weather';
    }

    public function buildQueryParams(mixed $params): array
    {
        $query_params = [
            'appid' => $this->getApiKey(),
            'lat' => $params['latitude'],
            'lon' => $params['longitude'],
            'units' => 'metric',
        ];

        return $query_params;
    }
}
