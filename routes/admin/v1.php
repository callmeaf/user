<?php

use Illuminate\Support\Facades\Route;

[
    $controllers,
    $prefix,
    $as,
    $middleware,
] = Base::getRouteConfigFromRepo(repo: \Callmeaf\User\App\Repo\Contracts\UserRepoInterface::class);

Route::apiResource($prefix, $controllers['user'])->middleware($middleware);
Route::prefix($prefix)->as($as)->middleware($middleware)->controller($controllers['user'])->group(function () {
    Route::get('trashed/list', 'trashed');
    Route::get('/export/{type}', 'export')->whereIn('type', array_map(fn(\Callmeaf\Base\App\Enums\ExportType $enum) => $enum->value, \Callmeaf\Base\App\Enums\ExportType::cases()));
    Route::post('/import/{type}', 'import')->whereIn('type', array_map(fn(\Callmeaf\Base\App\Enums\ExportType $enum) => $enum->value, \Callmeaf\Base\App\Enums\ExportType::cases()));

    Route::prefix('{user}')->group(function () {
        Route::patch('/restore', 'restore');
        Route::delete('/force', 'forceDestroy');
        Route::patch('/password', 'updatePassword');
        Route::patch('/status', 'updateStatus');
        Route::patch('/type', 'updateType');
    });
});
