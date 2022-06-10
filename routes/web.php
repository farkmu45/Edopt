<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/login', '/admin/login')->name('login');

Route::get('/', function () {
    return ['message' => 'All system is normal'];
});

Route::get('/link', function () {
    Artisan::call('storage:link');
});
