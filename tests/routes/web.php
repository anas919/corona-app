<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Route::resource('/users','UserController')->middleware('auth');
//users
Route::group(['middleware' => ['web'], 'prefix' => '/users'], function () {

	Route::get('', [UserController::class, 'index'])->name('users.index');
	Route::get('/create', [UserController::class, 'create'])->name('users.create');
	Route::post('', [UserController::class, 'store'])->name('users.store');
	Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
	Route::post('/update', [UserController::class, 'update'])->name('users.update');
	Route::post('/destroy', [UserController::class, 'destroy'])->name('users.destroy');
	Route::get('/{user}/show', [UserController::class, 'show'])->name('users.show');

	Route::post('/upload-two-mixers', [UserController::class, 'uploadTwoMixers'])->name('users.uploadTwoMixers');

	Route::post('/mark-sick', [UserController::class, 'markSick'])->name('users.markSick');

	

});