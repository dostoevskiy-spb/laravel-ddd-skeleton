<?php

use Illuminate\Support\Facades\Route;

Route::group([
                 'namespace' => 'Admin\v1\Controllers',
                 'prefix' => 'v1',
             ], function (): void {
    Route::group([
                     'prefix' => 'contractor',
                 ], function (): void {
        Route::get('/', 'ContractorController@index')
            ->name('contractor.all')
            ->middleware('auth');
    });
});
