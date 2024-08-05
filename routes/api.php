<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Playlist\GetPlaylistByCityController;

Route::middleware(['throttle:5,1'])->prefix('v1')->name('v1.')->group(function () {
    Route::get('playlist-by-city/{city}', GetPlaylistByCityController::class)->name('playlist-by-city');
});
