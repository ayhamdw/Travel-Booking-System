<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homePage');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/search/all' , '\App\Http\Controllers\FlightController@searchAll');
