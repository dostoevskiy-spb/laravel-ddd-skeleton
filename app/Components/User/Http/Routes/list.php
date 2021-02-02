<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'User\Versions'], function (): void {
    include dirname(__DIR__) . '/Versions/v1/Routes/list.php';
});
