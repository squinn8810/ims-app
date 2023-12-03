<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AngularController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemManager;
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
 * Routes executed by the inventory application. 
 */
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::post('/api/send-restock-notification', [NotificationController::class, 'restockNotification']);
    // Route::get('/scan/{scanActive?}', function ($scanActive = true) {
    //     return view('scan');
    // })->name('scan');
    Route::post('/api/scan', [ScannerController::class, 'analyze']);    
    Route::get('/api/scanned-list', [ScannerController::class, 'getScannedList']);    
});

/**
 * Routes executed by the inventory manager.
 */
Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::get('/reports', [AnalyticsController::class, 'dataView1']);
    Route::get('/reports/insights', [AnalyticsController::class, 'dataView2']);

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/inventory', [DashboardController::class, 'index']);
    Route::get('/inventory/items', [ItemController::class, 'index']);
    Route::get('/inventory/locations', [LocationController::class, 'index']);
    Route::get('/inventory/locations/{locID}/items', [ItemLocationController::class, 'index']);
    Route::get('inventory/transactions', [TransactionController::class, 'index']);

    Route::middleware('admin')->group(function () {
        //admin only routes create, update, delete


    });



    Route::post('/scan', [ScannerController::class, 'decode']);
});


/*
Route::middleware('admin')->group(function () {
    Route::get('/inventory', [ItemManager::class, 'createItem'])->name('inventory.add');
    Route::post('/inventory', [ItemManager::class, 'storeItem']);
});
*/



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
