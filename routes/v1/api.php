<?php

use \Illuminate\Support\Facades\Route;

Route::prefix(config('callmeaf-base.api.prefix_url'))->as(config('callmeaf-base.api.prefix_route_name'))->middleware(config('callmeaf-base.api.middlewares'))->group(function() {
    Route::middleware(config('callmeaf-user.middlewares.global'))->group(function() {
        Route::apiResource('users',config('callmeaf-user.controllers.users'));
        Route::prefix('users')->as('users.')->controller(config('callmeaf-user.controllers.users'))->group(function() {
            Route::patch('{user}/restore','restore')->name('restore');
            Route::delete('{user}/force','forceDestroy')->name('force_destroy');
        });

    });
});
