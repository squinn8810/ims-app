<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AngularController;

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
 * All Routes passed to Angular except '/api', '/sanctum'
 */
Route::any('/{any}', [AngularController::class, 'index'])->where('any', '^(?!(api)|(sanctum)).*$');
