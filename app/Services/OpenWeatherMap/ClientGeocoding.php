<?php

namespace App\Services\OpenWeatherMap;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use App\Services\OpenWeatherMap\AbstractClient;

class ClientGeocoding extends AbstractClient
{

    public function getPath(): string
    {
        return '/geo/1.0/direct';
    }

    public function buildQueryParams(mixed  $params): array 
    {
        $query_params = [
            'appid' => $this->getApiKey(),
            'q' => $params,
            'limit' => 1,
        ];
        return $query_params;
    }
}
