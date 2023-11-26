<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScannerController;
use App\Http\Controllers\AnalyticalController;
use App\Http\Controllers\InsightsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\InventoryManager\ItemManager;

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
Route::get('/about', function() {
        return view('about');
    });

/**
 * Routes executed by the inventory application. 
 */
Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::get('/notify', [NotificationController::class, 'restockNotification'])
    ->name('restock-notification');
    Route::get('/scan/{scanActive?}', function ($scanActive = true) {
        return view('scan');
    })->name('scan');

    Route::get('/reports', [AnalyticalController::class, 'index']);
    Route::get('/reports/insights', [InsightsController::class, 'index']);
    
    Route::post('/scan', [ScannerController::class, 'analyze']);    
});

/**
 * Routes executed by the inventory manager.
 */
Route::middleware(['auth', 'checkIsAdmin'])->group(function () {
    Route::get('/inventory', [ItemManager::class, 'createItem'])->name('inventory.add');
    Route::post('/inventory', [ItemManager::class, 'storeItem']);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
