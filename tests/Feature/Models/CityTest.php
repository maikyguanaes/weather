<?php

use App\Models\City;

it('creates city', function () {
   # given
   $city = City::factory()->create();
 
   # then
   expect($city)->toBeInstanceOf(City::class);
});

it('gets city by alias', function () {
   # given
    $city = City::factory()->as_sp()->create();

    # when
    $fetched_city = City::byAlias('சாவோ பாவுலோ')->first();
  
    # then
    expect($fetched_city->id)->toBe($city->id);
 });
 