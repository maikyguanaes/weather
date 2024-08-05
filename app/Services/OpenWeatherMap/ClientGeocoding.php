<?php

namespace App\Services\OpenWeatherMap;

use App\Models\City;
use Illuminate\Support\Arr;

class ClientGeocoding extends AbstractClient
{
    public function getPath(): string
    {
        return '/geo/1.0/direct';
    }

    public function buildQueryParams(mixed $params): array
    {
        $query_params = [
            'appid' => $this->getApiKey(),
            'q' => $params,
            'limit' => 1,
        ];

        return $query_params;
    }

    public function persist(mixed $params): ?City
    {
        $payload = head($params);
        if (! (bool) $payload) {
            return null;
        }

        $content = [];
        $content['name'] = Arr::get($payload, 'name');
        $content['latitude'] = Arr::get($payload, 'lat');
        $content['longitude'] = Arr::get($payload, 'lon');
        $content['country'] = Arr::get($payload, 'country');
        $content['state'] = Arr::get($payload, 'state');

        $alias = Arr::get($payload, 'local_names');

        if (! is_null($alias)) {
            $content['alias'] = Arr::flatten($alias);
        }

        $city = new City();
        $city->fill($content);
        $city->save();

        return $city;
    }
}
