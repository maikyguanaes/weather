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

it('gets null by alias', function () {
    # when
    $fetched_city = City::byAlias('சாவோ பாவுலோ')->first();

    # then
    expect($fetched_city)->toBeNull();
});

it('gets city by search', function () {
    # given
    $city = City::factory()->as_sp()->create();

    # when
    $fetched_city = City::search('சாவோ பாவுலோ')->first();

    # then
    expect($fetched_city->id)->toBe($city->id);
});

it('gets null by search', function () {
    # when
    $fetched_city = City::search('சாவோ பாவுலோ')->first();

    # then
    expect($fetched_city)->toBeNull();
});
