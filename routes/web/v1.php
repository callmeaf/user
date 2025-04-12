<?php

use Illuminate\Support\Facades\Route;

[
    $controllers,
    $prefix,
    $as,
    $middleware,
] = Base::getRouteConfigFromRepo(repo: \Callmeaf\User\App\Repo\Contracts\UserRepoInterface::class);

Route::resource($prefix, $controllers['user'])->middleware($middleware);
// Route::prefix($prefix)->as($as)->middleware($middleware)->controller($controllers['user'])->group(function () {
    // Route::get('trashed/list', 'trashed');
    // Route::prefix('{user}')->group(function () {
        // Route::patch('/restore', 'restore');
        // Route::delete('/force', 'forceDestroy');
    // });
// });
