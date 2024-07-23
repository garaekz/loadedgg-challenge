<?php

use Illuminate\Support\Facades\Route;

Route::get('{catchall?}', function () {
    return view('app');
})->where('catchall', '.*');
