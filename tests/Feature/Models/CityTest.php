<?php

use App\Models\City;

it('creates city', function () {
   $city = City::factory()->create();
 
   expect($city)->toBeInstanceOf(City::class);
});

it('gets city by alias', function () {
    $city = City::factory()->as_sp()->create();

    $fetched_city = City::byAlias('சாவோ பாவுலோ')->first();
  
    expect($fetched_city->id)->toBe($city->id);
 });
 