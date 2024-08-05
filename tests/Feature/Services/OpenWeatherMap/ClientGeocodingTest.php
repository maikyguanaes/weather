<?php

use App\Models\City;
use App\Services\OpenWeatherMap\ClientGeocoding;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Response as StatusCode;

uses()->group('services');

it('ClientGeocoding->fetch() returns data successfully as SP/SP/BR', function () {

    # given
    $client = new ClientGeocoding();

    # when
    $payload_response = file_get_contents(base_path('tests/fixtures/open_weather_map/geocoding-sp-sp-br.json'));
    $query_params = [
        'appid' => 'openweathermap-api-key',
        'q' => 'São Paulo,São Paulo,BR',
        'limit' => 1,
    ];

    Http::fake([
        'https://api.openweathermap.org/*' => Http::response($payload_response, StatusCode::HTTP_OK),
    ]);
    $response = $client->fetch($query_params);

    # then
    expect($response)->toBeInstanceOf(Response::class);
    expect($response->status())->toBe(StatusCode::HTTP_OK);
});

it('ClientGeocoding->fetch() returns data successfully as SP/BA/BR', function () {

    # given
    $client = new ClientGeocoding();

    # when
    $payload_response = file_get_contents(base_path('tests/fixtures/open_weather_map/geocoding-sp-ba-br.json'));
    $query_params = [
        'appid' => 'openweathermap-api-key',
        'q' => 'São Paulo,Bahia,BR',
        'limit' => 1,
    ];

    Http::fake([
        'https://api.openweathermap.org/*' => Http::response($payload_response, StatusCode::HTTP_OK),
    ]);
    $response = $client->fetch($query_params);

    # then
    expect($response)->toBeInstanceOf(Response::class);
    expect($response->status())->toBe(StatusCode::HTTP_OK);
});

it('ClientGeocoding->fetch() returns 401 error', function () {

    # given
    $client = new ClientGeocoding();

    # when
    $payload_response = file_get_contents(base_path('tests/fixtures/open_weather_map/geocoding-sp-ba-br.json'));
    $query_params = [
        'appid' => 'openweathermap-api-key',
        'q' => 'São Paulo,Bahia,BR',
        'limit' => 1,
    ];

    Http::fake([
        'https://api.openweathermap.org/*' => Http::response($payload_response, StatusCode::HTTP_UNAUTHORIZED),
    ]);
    $response = $client->fetch($query_params);

    # then
    expect($response)->toBeInstanceOf(Response::class);
    expect($response->status())->toBe(StatusCode::HTTP_UNAUTHORIZED);
});

it('ClientGeocoding->persist() returns City successfully', function (string $path) {

    # given
    expect(City::count())->toBe(0);
    $client = new ClientGeocoding();

    # when
    $payload_response = file_get_contents(base_path('tests/fixtures/open_weather_map/'.$path.'.json'));
    $query_params = [
        'appid' => 'openweathermap-api-key',
        'q' => 'São Paulo,São Paulo,BR',
        'limit' => 1,
    ];

    Http::fake([
        'https://api.openweathermap.org/*' => Http::response($payload_response, StatusCode::HTTP_OK),
    ]);
    $response = $client->fetch($query_params);
    $result = $client->persist($response->json());

    # then
    expect(City::count())->toBe(1);
    expect($result)->toBeInstanceOf(City::class);
    expect($response->status())->toBe(StatusCode::HTTP_OK);
})->with(['geocoding-sp-sp-br', 'geocoding-sp-ba-br']);

it('ClientGeocoding->persist() returns null successfully', function () {

    # given
    expect(City::count())->toBe(0);
    $client = new ClientGeocoding();

    # when
    $payload_response = file_get_contents(base_path('tests/fixtures/open_weather_map/geocoding-empty.json'));
    $query_params = [
        'appid' => 'openweathermap-api-key',
        'q' => 'São Paulo,São Paulo,BR',
        'limit' => 1,
    ];

    Http::fake([
        'https://api.openweathermap.org/*' => Http::response($payload_response, StatusCode::HTTP_OK),
    ]);
    $response = $client->fetch($query_params);
    $result = $client->persist($response->json());

    # then
    expect(City::count())->toBe(0);
    expect($result)->toBeNull();
    expect($response->status())->toBe(StatusCode::HTTP_OK);
});
