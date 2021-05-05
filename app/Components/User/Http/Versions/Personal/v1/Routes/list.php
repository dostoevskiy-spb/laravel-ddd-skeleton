<?php

use Illuminate\Support\Facades\Route;

Route::group([
                 'namespace' => 'Personal\v1\Controllers',
                 'prefix' => 'v1',
             ], function (): void {
    Route::group([
                     'prefix' => 'user',
                 ], function (): void {
        Route::get('/', 'UserController@index')
            ->name('user.current')
            ->middleware('auth');
    });
});
