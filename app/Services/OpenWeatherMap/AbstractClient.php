<?php

namespace App\Services\OpenWeatherMap;

use Illuminate\Support\Facades\Http;
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

    public function getUrl(): string {
        return $this->getApiUrl() . $this->getPath();
    }

    public function fetch(array $params): Response
    {
        $response = Http::get($this->getUrl(), $params);

        return $response;
    }

    abstract public function getPath(): string;
    abstract public function buildQueryParams(string $params): array;
}
