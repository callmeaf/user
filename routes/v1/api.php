<?php

use \Illuminate\Support\Facades\Route;

Route::prefix(config('callmeaf-base.api.prefix_url'))->as(config('callmeaf-base.api.prefix_route_name'))->middleware(config('callmeaf-base.api.middlewares'))->group(function() {
    Route::middleware(config('callmeaf-user.middlewares.global'))->group(function() {
        Route::apiResource('users',config('callmeaf-user.controllers.users'));
        Route::prefix('users')->as('users.')->controller(config('callmeaf-user.controllers.users'))->group(function() {
            Route::prefix('{user}')->group(function() {
                Route::patch('/status','statusUpdate')->name('status_update');
                Route::patch('/restore','restore')->name('restore');
                Route::delete('/force','forceDestroy')->name('force_destroy');
                Route::patch('/roles','syncRoles')->name('roles.sync');
            });
            Route::get('/trashed/index','trashed')->name('trashed.index');
        });

    });
});
