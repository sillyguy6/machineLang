<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;




Route::get('/', function () {
    return view('index');
});


Route::fallback(function () {
    return view('index');
});


