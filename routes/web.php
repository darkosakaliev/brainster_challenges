<?php

use App\Http\Controllers\ProjectController;
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

Route::get('/', [ProjectController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login-user', [UserController::class, 'userAuth'])->name('userAuth');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::post('/project/store', [ProjectController::class, 'store'])->name('project.store');
Route::put('/project/{project}/edit', [ProjectController::class, 'update'])->name('project.update');
Route::delete('/project/{project}/delete', [ProjectController::class, 'destroy'])->name('project.destroy');
