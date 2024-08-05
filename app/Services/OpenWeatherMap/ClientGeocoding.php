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

    public function buildQueryParams(string $params): array 
    {
        $query_params = [
            'appid' => $this->getApiKey(),
            'q' => $params,
            'limit' => 1,
        ];
        return $query_params;
    }

    public function getUrl(): string {
        return $this->getApiUrl() . $this->getPath();
    }

    public function fetch(array $params): Response
    {
        $response = Http::get($this->getUrl(), $params);

        return $response;
    }
}
