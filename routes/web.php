<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Redis;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('redis', function () {
    Redis::set('name', 'Test Redis');
    Redis::set('password', '123456');
    // Redis::del('name');
    $value = Redis::get('name');
    $pass = Redis::get('password');

    // $value = 

    // Cache::put('name','ahihi',600);
    // Redis::del('name');

    // $value = Cache::forget('name');
    // $value = Cache::get('name');

    dd($value,$pass);
});
