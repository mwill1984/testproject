<?php

use App\Http\Controllers\Store\Location\LocationController;
use App\Http\Controllers\Store\EmployeeShopperController;
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

Route::name('create')
    ->get('/create', [LocationController::class, 'create']);

Route::name('save')
    ->post('/create', [LocationController::class, 'store']);

Route::name('edit')
    ->get('/edit/{locationUuid}', [LocationController::class, 'edit']);

Route::name('update')
    ->post('/update', [LocationController::class, 'update']);

Route::name('queue')
    ->get('/{locationUuid}', [LocationController::class, 'queue']);

Route::name('checkout')
    ->post('/checkout/{shopperUuid}', [EmployeeShopperController::class, 'checkout']);


