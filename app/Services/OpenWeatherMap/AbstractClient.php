<?php

namespace App\Services\OpenWeatherMap;

use Illuminate\Http\Client\Response;
use App\Services\OpenWeatherMap\ClientInterface;

abstract class AbstractClient implements ClientInterface
{
    private $api_url;

    private $api_key;

    public function __construct()
    {
        $this->api_url = env('OPEN_WEATHER_MAP_URL');
        $this->api_key = env('OPEN_WEATHER_MAP_API_KEY');
    }

    public function getApiUrl(): string 
    {
        return $this->api_url;
    }

    public function getApiKey(): string
    {
        return $this->api_key;
    }

    abstract public function getPath(): string;
    abstract public function buildQueryParams(string $params): array;
    abstract public function getUrl(): string;
    abstract public function fetch(array $params): Response;
}
