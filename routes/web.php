<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile/{nama}/{npm}/{kelas}', [ProfileController::class, 'index'])->name('profile');

Route::get('/login', function () {
    return view('login');
});

Route::get('/user',[UserController::class,'index'])->name('user.index');
Route::post('/user',[UserController::class,'store'])->name('user.store');
Route::put('/user/{id}',[UserController::class,'update'])->name('user.update');
Route::delete('/user/{id}',[UserController::class,'delete'])->name('user.delete');
