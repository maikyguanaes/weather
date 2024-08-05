<?php

use App\Services\OpenWeatherMap\ClientGeocoding;

uses()->group('services');

it('ClientGeocoding->getPath() returns path', function () {

    # given
    $client = new ClientGeocoding();

    # then
    expect($client->getPath())->toBe('/geo/1.0/direct');
});

it('ClientGeocoding->buildQueryParams() returns query params', function (string $params) {

    # given
    $client = new ClientGeocoding();
    $query_params = [
        'appid' => 'openweathermap-api-key',
        'q' => $params,
        'limit' => 1,
    ];

    # then
    expect($client->buildQueryParams($params))->toBe($query_params);
})->with(['São Paulo', 'São Paulo,São Paulo,BR']);

it('ClientGeocoding->getUrl() returns full url', function () {

    # given
    $client = new ClientGeocoding();

    # then
    expect($client->getUrl())->toBe('https://api.openweathermap.org/geo/1.0/direct');
});
