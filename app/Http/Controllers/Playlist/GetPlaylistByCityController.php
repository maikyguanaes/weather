<?php

namespace App\Http\Controllers\Playlist;

use App\Models\City;
use App\Enums\MusicCategoryEnum;
use App\Http\Controllers\Controller;
use App\Services\OpenWeatherMap\ClientGeocoding;
use App\Services\OpenWeatherMap\ClientCurrentWeather;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class GetPlaylistByCityController extends Controller
{
    public function __invoke(string $city, Request $request)
    {
        $city_instance = City::search($city)->first();

        if (is_null($city_instance)) {
            $city_instance = $this->fetchAndCreateCityFromGeocoding($city);
        }

        if (is_null($city_instance)) {
            return response()->json(['message' => 'City not found'], Response::HTTP_NOT_FOUND);
        }

        $current_weather = $this->fetchCurrentWeather($city_instance);
        $temperature = Arr::get($current_weather, 'main.temp');

        $playlist = $this->getPlaylistByTemperature($temperature);

        return response()->json($playlist, Response::HTTP_OK);
    }

    private function fetchAndCreateCityFromGeocoding(string $city): ?City
    {
        $client_geocoding = new ClientGeocoding();
        $params_geocoding = $client_geocoding->buildQueryParams($city);
        $response_geocoding = $client_geocoding->fetch($params_geocoding);

        return $client_geocoding->persist($response_geocoding->json());
    }

    private function fetchCurrentWeather(City $city): array
    {
        $params = [
            'latitude' => $city->latitude,
            'longitude' => $city->longitude,
        ];

        $cache_key = implode('::', $params);

        $weather = Cache::remember($cache_key, 3600, function () use ($params) {
            $client_current_weather = new ClientCurrentWeather();
            $params_current_weather = $client_current_weather->buildQueryParams($params);
            $response_current_weather = $client_current_weather->fetch($params_current_weather);

            return $response_current_weather->json();
        });

        return $weather;
    }

    private function getPlaylistByTemperature(mixed $temperature): array
    {
        $category = match (true) {
            $temperature < 10 => MusicCategoryEnum::CLASSIC->value,
            $temperature <= 25 => MusicCategoryEnum::ROCK->value,
            $temperature > 25 => MusicCategoryEnum::POP->value,
        };

        $playlists = [
            MusicCategoryEnum::POP->value => [
                'playlist' => 'https://open.spotify.com/playlist/0K8DNHMwJaZmERK4FeaAOJ',
                'category' => MusicCategoryEnum::POP->value,
                'temperature' => $temperature,
            ],
            MusicCategoryEnum::ROCK->value => [
                'playlist' => 'https://open.spotify.com/playlist/2BCkGjRMRz0TEn8xwsa29V',
                'category' => MusicCategoryEnum::ROCK->value,
                'temperature' => $temperature,
            ],
            MusicCategoryEnum::CLASSIC->value => [
                'playlist' => 'https://open.spotify.com/playlist/1h0CEZCm6IbFTbxThn6Xcs',
                'category' => MusicCategoryEnum::CLASSIC->value,
                'temperature' => $temperature,
            ],

        ];

        return $playlists[$category];
    }
}
