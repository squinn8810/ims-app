<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AngularController;
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

/**
 * All PUT Routes passed to Angular except '/api', '/sanctum'
 */
Route::any('/{any}', [AngularController::class, 'index'])->where('any', '^(?!(api)|(sanctum)).*$');

/**
 * Routes executed by the scanner application. 
 */
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::post('/api/send-restock-notification', [NotificationController::class, 'restockNotification']);    
    Route::post('/api/scan', [ScannerController::class, 'scanToSession']);    
    Route::get('/api/scanned-list', [ScannerController::class, 'getScannedList']);    
});

/**
 * Routes executed by the inventory manager.
 */
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/api/reports', [AnalyticsController::class, 'dataView1']);
    Route::get('/api/reports/insights', [AnalyticsController::class, 'dataView2']);
    Route::get('/api/inventory', [DashboardController::class, 'index']);
    Route::get('/api/inventory/items', [ItemController::class, 'index']);
    Route::get('/api/inventory/locations', [LocationController::class, 'index']);
    Route::get('/api/inventory/locations/{locID}/items', [ItemLocationController::class, 'index']);
    Route::get('/api/inventory/transactions', [TransactionController::class, 'index']);
    Route::get('/api/profile', [ProfileController::class, 'getCurrentProfile']);    
    Route::patch('/api/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/api/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/api/send-restock-notification', [NotificationController::class, 'restockNotification']);

    Route::get('/api/users', [UserController::class, 'showAll']);
    Route::get('/api/users/user/{userId}', [UserController::class, 'show']);
    Route::middleware('admin')->group(function () {
        //admin only routes create, update, delete
        Route::patch('/api/users/user/{userId}', [UserController::class, 'update']);
        Route::delete('/api/users/user/{userId}', [UserController::class, 'delete']);
    });
});


/*
Route::middleware('admin')->group(function () {
    Route::get('/inventory', [ItemManager::class, 'createItem'])->name('inventory.add');
    Route::post('/inventory', [ItemManager::class, 'storeItem']);
});
*/

require __DIR__ . '/auth.php';
