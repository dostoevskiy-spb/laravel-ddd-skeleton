<?php

use Illuminate\Support\Facades\Route;

Route::group([
                 'namespace' => 'Admin\v1\Controllers',
                 'prefix' => 'v1',
                 'middleware' => 'auth',
             ], function (): void {
    Route::group([
                     'prefix' => 'contractor',
                 ], function (): void {
        Route::get('', 'ContractorController@list')
            ->name('contractor.all');
        Route::post('', 'ContractorController@create')
            ->name('contractor.create');
        Route::get('{contractorId:[0-9]+}', 'ContractorController@get')
            ->name('contractorId.get');
        Route::post('{contractorId:[0-9]+}', 'ContractorController@update')
            ->name('contractorId.update');
        Route::delete('{contractorId:[0-9]+}', 'ContractorController@delete')
            ->name('contractorId.delete');
    });
});
