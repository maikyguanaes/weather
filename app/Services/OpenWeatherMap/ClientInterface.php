<?php

namespace App\Services\OpenWeatherMap;

use Illuminate\Http\Client\Response;

interface ClientInterface
{
    /**
     * getApiKey
     *
     * @return string 
     */
    public function getApiKey(): string;

    /**
     * getApiUrl
     *
     * @return string 
     */
    public function getApiUrl(): string;

    /**
     * getPath
     *
     * @return string gets path of service in OpenWeatherMap
     */
    public function getPath(): string;

    /**
     * getUrl
     *
     * @return string
     */
    public function getUrl(): string;

    /**
     * buildQueryParams
     *
     * @param string
     * @return array
     */
    public function buildQueryParams(string $params): array;

    /**
     * fetch
     *
     * @param array
     */
    public function fetch(array $params): Response;
}
