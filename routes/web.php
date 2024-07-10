<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExternalApiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/externalapi', [ExternalApiController::class, 'index']);
Route::put('/externalapi/update', [ExternalApiController::class, 'update'])->name('externalapi.update');