<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\contactController;

Route::get('/contacts', [contactController::class, 'index']);
Route::get('/contacts/create', [contactController::class, 'create']);
Route::post('/contacts', [contactController::class, 'store']);
Route::get('/contacts/{id}', [contactController::class, 'show']);
Route::get('/contacts/{id}/edit', [contactController::class, 'edit']);
Route::put('/contacts/{id}', [contactController::class, 'update']);
Route::delete('/contacts/{id}', [contactController::class, 'destroy']);
