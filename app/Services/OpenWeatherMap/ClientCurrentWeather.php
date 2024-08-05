<?php

namespace App\Services\OpenWeatherMap;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use App\Services\OpenWeatherMap\AbstractClient;

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
            'lat' => $params['latiture'],
            'lon' => $params['longitude'],
            'units' => 'metric',
        ];
        return $query_params;
    }
}
