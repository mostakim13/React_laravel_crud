<?php

use App\Http\Controllers\API\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\StudentController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('contacts', [ContactController::class, 'index']);
Route::post('/add-contact', [ContactController::class, 'store']);
Route::get('/edit-contact/{id}', [ContactController::class, 'edit']);
Route::put('update-contact/{id}', [ContactController::class, 'update']);
Route::delete('delete-contact/{id}', [ContactController::class, 'destroy']);
