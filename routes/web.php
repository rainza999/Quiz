<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'index']);



Route::get('/users', function(){
    return view('users');
})->name('users');
Route::get('frm/user/loading', [App\Http\Controllers\UserController::class, 'all']);
// // Route::get('usrdetail/{id}', [App\Http\Controllers\UserController::class, 'edit']);
// Route::get('usrdetail/{id}', [App\Http\Controllers\UserController::class, 'edit']);
Route::get('/edit/{id}',  [App\Http\Controllers\UserController::class, 'edit'])->name('edit');
Route::get('/delete/{id}',  [App\Http\Controllers\UserController::class, 'delete'])->name('delete');

Auth::routes();
Route::get('/dashboard', function(){
    return view('dashboard');
})->name('dashboard');
Route::post('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');
Route::post('/frm/edit', [App\Http\Controllers\UserController::class, 'frmedit']);
