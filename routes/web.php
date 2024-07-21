<?php

use App\Events\OrderCreated;
use App\Models\Order;
use App\Models\User;
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

Route::get('order/create',function(){
    $order = Order::create([
        'product_name' => 'sản phẩm 1',
        'quantity' => 2,
        'price' => 100000,
    ]);

    $user = User::find(1);

    event(new OrderCreated($order,$user));

    return 'ok';
});

Route::get('notification', function () {
    $user = User::find(1);
    $notifications = $user->notifications;

    dd($notifications);
});