<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [
    \App\Http\Controllers\AuthenticationController::class, 'login'
])->name('auth.login');

Route::middleware('auth.jwt')->group(function() {

    Route::delete('logout', [
        \App\Http\Controllers\AuthenticationController::class, 'logout'
    ])->name('auth.logout');
    
    Route::get('items', [\App\Http\Controllers\ItemController::class, 'index'])
        ->name('items.index');
    
    Route::get('items/{item}', [\App\Http\Controllers\ItemController::class, 'show'])
        ->name('items.show');

    Route::post('items/{item}/bids', [
        \App\Http\Controllers\BidController::class, 'store'
    ])->name('bids.store');
});

