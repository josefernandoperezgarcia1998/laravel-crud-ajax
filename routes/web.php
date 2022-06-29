<?php

use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::resource('/userData', UserController::class)->names('users');
// Route::post('getUserData', [UserController::class, 'getUsersData'])->name('getUserData');

// Route::resource('/userData','UserController');
Route::resource('/userData', UserController::class);
Route::post('/userData/getUserData',[UserController::class, 'getUserData']);
Route::post('/saveUser',[UserController::class, 'saveUser'])->name('save-user');
Route::put('/userUpdate', [UserController::class, 'userUpdate'])->name('user-update');
Route::delete('/userDelete/{id}', [UserController::class, 'userDelete'])->name('user-delete');

Route::view('/select2', 'users.select2');   
Route::get('/select2-autocomplete-ajax', [UserController::class, 'dataAjax'])->name('select2-ajax');