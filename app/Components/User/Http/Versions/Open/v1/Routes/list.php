<?php

use Illuminate\Support\Facades\Route;

Route::group([
                 'namespace' => 'Open\v1\Controllers',
                 'prefix' => 'v1',
             ], function (): void {
    Route::group([
                     'prefix' => 'user',
                 ], function (): void {
        Route::post('/login', 'AuthenticationController@login')
            ->name('user.login');

        Route::get('/logout', 'AuthenticationController@logout')
            ->name('user.logout')
            ->middleware('auth');
    });
});
