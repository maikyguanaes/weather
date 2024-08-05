<?php

use App\Services\OpenWeatherMap\ClientCurrentWeather;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Response as StatusCode;

uses()->group('services');

it('ClientCurrentWeather->fetch() returns data successfully', function () {

    # given
    $client = new ClientCurrentWeather();

    # when
    $payload_response = file_get_contents(base_path('tests/fixtures/open_weather_map/current-weather-sp.json'));
    $query_params = [
        'appid' => 'openweathermap-api-key',
        'lat' => -23.5506507,
        'lon' => -46.6333824,
        'units' => 'metric',
    ];

    Http::fake([
        'https://api.openweathermap.org/*' => Http::response($payload_response, StatusCode::HTTP_OK),
    ]);
    $response = $client->fetch($query_params);

    # then
    expect($response)->toBeInstanceOf(Response::class);
    expect($response->status())->toBe(StatusCode::HTTP_OK);
});

it('ClientCurrentWeather->fetch() returns 401 error', function () {

    # given
    $client = new ClientCurrentWeather();

    # when
    $payload_response = file_get_contents(base_path('tests/fixtures/open_weather_map/current-weather-error-401.json'));
    $query_params = [
        'appid' => 'openweathermap-api-key',
        'lat' => -23.5506507,
        'lon' => -46.6333824,
        'units' => 'metric',
    ];

    Http::fake([
        'https://api.openweathermap.org/*' => Http::response($payload_response, StatusCode::HTTP_UNAUTHORIZED),
    ]);
    $response = $client->fetch($query_params);

    # then
    expect($response)->toBeInstanceOf(Response::class);
    expect($response->status())->toBe(StatusCode::HTTP_UNAUTHORIZED);
});
