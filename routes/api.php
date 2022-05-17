<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\OrphanageController;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\UserResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:api'])->group(function () {
    // Route::get('/user', function () {
    //     return new UserResource(auth()->user());
    // });
});

Route::get('/articles', [ArticleController::class, 'getAll']);
Route::get('/articles/{article}', [ArticleController::class, 'getById']);

Route::get('/appointments', [AppointmentController::class, 'getAll']);
Route::get('/appointments/{appointment}', [AppointmentController::class, 'getById']);

Route::get('/children/{child}', [ChildController::class, 'getById']);

Route::get('/orphanages/{orphanage}', [OrphanageController::class, 'getById']);
Route::get('/orphanages', [OrphanageController::class, 'search']);
