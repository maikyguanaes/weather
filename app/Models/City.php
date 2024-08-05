<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country',
        'state',
        'latitude',
        'longitude',
        'alias',
    ];

    protected $casts = [
        'alias' => 'array',
    ];

    /**
     * Scope a query to fetch city by alias.
     */
    public function scopeByAlias(Builder $query, string $alias): void
    {
        $query->where('alias', '@>', '['.json_encode($alias).']');
    }

    public function scopeSearch(Builder $query, string $filter): void
    {
        $extracted_city_params = array_filter(explode(',', $filter), function ($value) {
            return (bool) $value;
        });

        $city_name = Arr::get($extracted_city_params, 0);
        if ($city_name) {
            $query = $query->byAlias($city_name);
        }

        $city_state = Arr::get($extracted_city_params, 1);
        if ($city_state) {
            $query = $query->where('state', $city_state);
        }

        $city_country = Arr::get($extracted_city_params, 2);
        if ($city_country) {
            $query = $query->where('country', $city_country);
        }

    }
}
