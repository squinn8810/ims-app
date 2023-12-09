<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScannerController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\InventoryManager\DashboardController;
use App\Http\Controllers\InventoryManager\ItemController;
use App\Http\Controllers\InventoryManager\ItemLocationController;
use App\Http\Controllers\InventoryManager\LocationController;
use App\Http\Controllers\InventoryManager\TransactionController;
use App\Http\Controllers\InventoryManager\UserController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * API Routes have '/api' prefix added to avoid web.php routing to Angular
 */

/**
 * Routes executed by the scanner application. 
 */
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::post('/send-restock-notification', [NotificationController::class, 'restockNotification']);   
    Route::post('/send-low-supply-notification', [NotificationController::class, 'lowSupplyNotification']); 
    Route::post('/scan', [ScannerController::class, 'scanToSession']);    
    Route::get('/scanned-list', [ScannerController::class, 'getScannedList']);    
});

/**
 * Routes executed by the inventory manager and reports.
 */
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
 * Routes profile and Manage Users
 */
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/profile', [ProfileController::class, 'getCurrentProfile']);    
    Route::get('/users', [UserController::class, 'showAll']);
    Route::get('/users/user/{userId}', [UserController::class, 'show']);
    
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

 
    
    Route::middleware('admin')->group(function () {
        //admin only routes create, update, delete
        Route::patch('/users/user/{userId}', [UserController::class, 'update']);
        Route::delete('/users/user/{userId}', [UserController::class, 'delete']);
    });
});

require __DIR__ . '/auth.php';
