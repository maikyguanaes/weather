<?php

namespace App\Models;

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
        $query->where("alias", '@>', '[' . json_encode($alias) . ']');
    }
}
