<?php

use App\Http\Controllers\Api\BorrowingController;
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
	//Route::apiResource('borrowed-books', BorrowedBooksController::class)->except(['index','show','update','destroy']);
});

//Route::apiResource('borrowed-books', BorrowedBooksController::class)->except(['index','show','update','destroy']);
Route::post('borrowing', [BorrowingController::class, 'store']);
