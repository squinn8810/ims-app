<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AngularController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemManager;
use App\Http\Controllers\ScannerController;
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
 * All PUT Routes passed to Angular except '/api', '/sanctum'
 */
Route::any('/{any}', [AngularController::class, 'index'])->where('any', '^(?!(api)|(sanctum)).*$');

/**
 * Routes executed by the scanner. 
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
    Route::get('/inventory', [ItemManager::class, 'createItem'])->name('inventory.add');
    Route::post('/inventory', [ItemManager::class, 'storeItem']);


});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
