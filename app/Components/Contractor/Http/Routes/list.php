<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Contractor\Http\Versions'], function (): void {
    include dirname(__DIR__) . '/Versions/Admin/v1/Routes/list.php';
});
