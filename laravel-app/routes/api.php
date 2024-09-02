<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DictionaryController;


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

Route::get('/analyze', [HomeController::class, 'analyze'])
    ->name('api.analyze');

Route::post('/dictionary', [DictionaryController::class, 'addVocab'])
    ->name('api.dictionary.addVocab');

Route::delete('/dictionary', [DictionaryController::class, 'removeVocab'])
    ->name('api.dictionary.removeVocab');