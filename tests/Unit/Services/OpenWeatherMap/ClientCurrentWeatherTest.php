<?php

use App\Services\OpenWeatherMap\ClientCurrentWeather;

uses()->group('services');

it('ClientCurrentWeather->getPath() returns path', function () {

    # given
    $client = new ClientCurrentWeather();

    # then
    expect($client->getPath())->toBe('/data/2.5/weather');
});

it('ClientCurrentWeather->buildQueryParams() returns query params', function () {

    # given
    $client = new ClientCurrentWeather();
    $params = [
        'latiture' => -23.5506507,
        'longitude' => -46.6333824,
    ];
    $query_params = [
        'appid' => 'openweathermap-api-key',
        'lat' => $params['latiture'],
        'lon' => $params['longitude'],
        'units' => 'metric',
    ];

    # then
    expect($client->buildQueryParams($params))->toBe($query_params);
});

it('ClientCurrentWeather->getUrl() returns full url', function () {

    # given
    $client = new ClientCurrentWeather();

    # then
    expect($client->getUrl())->toBe('https://api.openweathermap.org/data/2.5/weather');
});
