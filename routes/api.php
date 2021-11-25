<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('sale/retrieve' , [SaleController::class, 'retrieveSales']);
Route::post('sale/summary' , [SaleController::class, 'summary']);
Route::resource('sale' , SaleController::class);
