<?php

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
use App\Http\Controllers\UserController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/aaa', function () {
    return 'aaa';
});
//API
Route::post('users/store_user', [UserController::class, 'storeUser'])->name('users.storeUser');

Route::post('users/{user_id}/upload_mixers', [UserController::class, 'uploadMixers'])->name('users.uploadMixers');
Route::get('users/{user_id}/mark_sick', [UserController::class, 'markAsSick'])->name('users.markAsSick');
Route::get('users/{person1}/{person2}/mix', [UserController::class, 'mixUsers'])->name('users.mixUsers');
Route::get('users/{user_id}/fetch_mixers', [UserController::class, 'fetchMixers'])->name('users.fetchMixers');