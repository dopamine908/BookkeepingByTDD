<?php

use App\Http\Controllers\BookkeepingController;
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

Route::middleware('auth:api')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);

Route::post('Bookkeeping', [BookkeepingController::class, 'create']);
Route::put('Bookkeeping/{id}', [BookkeepingController::class, 'update']);
Route::delete('Bookkeeping/{id}', [BookkeepingController::class, 'delete']);
