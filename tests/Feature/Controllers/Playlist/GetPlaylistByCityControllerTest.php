<?php

use Illuminate\Http\Response;
use Illuminate\Http\Response as StatusCode;

it('gets a playlist by city', function () {
    # given
    $geocoding_response = file_get_contents(base_path('tests/fixtures/open_weather_map/geocoding-sp-sp-br.json'));
    $current_weather_response = file_get_contents(base_path('tests/fixtures/open_weather_map/current-weather-sp.json'));

    # when
    Http::fake([
        'https://api.openweathermap.org/geo/1.0/direct*' => Http::response($geocoding_response, StatusCode::HTTP_OK),
        'https://api.openweathermap.org/data/2.5/weather*' => Http::response($current_weather_response, StatusCode::HTTP_OK),
    ]);
    $response = $this->getJson(route('v1.playlist-by-city', 'São Paulo'));

    # then

    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonStructure([
        'playlist',
        'category',
        'temperature',
    ]);
});