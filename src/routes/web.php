<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Session;

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
    return view('index', ['user' => Session::get('user')]);
})->name('home');

Route::get('login', function () {
    return view('login', ['user' => Session::get('user')]);
})->name('login');

Route::get('info', function () {
    return view('info', ['user' => Session::get('user')]);
})->name('info');

Route::post('info', [UsersController::class, 'store'])->name('users.store');
Route::get('logout',[UsersController::class, 'destroy'])->name('users.destroy');
