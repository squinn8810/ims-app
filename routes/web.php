<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AngularController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\InventoryManager\ItemController;
use App\Http\Controllers\InventoryManager\LocationController;
use App\Http\Controllers\InventoryManager\DashboardController;
use App\Http\Controllers\InventoryManager\TransactionController;
use App\Http\Controllers\InventoryManager\ItemLocationController;

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

/**
 * Public routes to static webpages.
 */
Route::get('/about', function () {
    return view('about');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/reports', [AnalyticsController::class, 'dataView1']);
    Route::get('/reports/insights', [AnalyticsController::class, 'dataView2']);
    
    Route::get('/inventory', [DashboardController::class, 'index']);
    Route::get('/inventory/items', [ItemController::class, 'index']);
    Route::get('/inventory/locations', [LocationController::class, 'index']);
    Route::get('/inventory/locations/{locID}/items', [ItemLocationController::class, 'index']);
    Route::get('/inventory/transactions', [TransactionController::class, 'index']);
});



/**
 * All Routes passed to Angular except '/api', '/sanctum'
 */
Route::any('/{any}', [AngularController::class, 'index'])->where('any', '^(?!(api)|(sanctum)).*$');