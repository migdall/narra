<?php

use App\Http\Controllers\ArtworkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Museum Sandbox API Endpoints
Route::prefix('v1')->group(function () {
    Route::get('/artworks', [ArtworkController::class, 'index']);
    Route::get('/artworks/{artwork}', [ArtworkController::class, 'show']);
});
