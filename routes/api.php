<?php

use App\Http\Controllers\Api\BookController;
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

Route::middleware('auth:sanctum')->group(function(){
	Route::apiResource('books', BookController::class);
});

Route::apiResource('books', BookController::class);

//Route::apiResource('borrowed-books', BorrowedBooksController::class)->except(['index','show','update','destroy']);
//Route::post('borrowing', [BookController::class,'store']);
