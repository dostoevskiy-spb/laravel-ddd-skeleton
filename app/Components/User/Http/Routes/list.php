<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'User\Http\Versions'], function (): void {
    include dirname(__DIR__) . '/Versions/Admin/v1/Routes/list.php';
    include dirname(__DIR__) . '/Versions/Open/v1/Routes/list.php';
    include dirname(__DIR__) . '/Versions/Personal/v1/Routes/list.php';
});
