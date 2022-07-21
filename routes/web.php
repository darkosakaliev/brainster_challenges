<?php

use App\Http\Controllers\MatchController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
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
})->name('home');

Route::middleware(['auth'])->group(function () {

    Route::get('/matches', [MatchController::class, 'index'])->name('matches');

    Route::middleware(['admin'])->group(function () {

        Route::resource('players', PlayerController::class);
        Route::resource('teams', TeamController::class);
        Route::resource('matches', MatchController::class)->except('index');

    });
});



require __DIR__ . '/auth.php';
