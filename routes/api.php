<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DesaController;

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


Route::get('/desa/',[DesaController::class, 'index'] )->name('index.desa.api');
Route::get('/desa/{id}',[DesaController::class, 'detail'] )->name('detail.desa.api');
Route::post('/desa/',[DesaController::class, 'store'] )->name('store.desa.api');
Route::put('/desa/{id}',[DesaController::class, 'update'] )->name('update.desa.api');
Route::delete('/desa/{id}',[DesaController::class, 'delete'] )->name('delete.desa.api');