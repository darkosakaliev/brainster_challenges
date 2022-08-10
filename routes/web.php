<?php

use App\Http\Controllers\ActivationTokenController;
use App\Models\User;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'inactive'])->name('dashboard');

Route::get('/inactive', function () {
    return view('inactive');
})->name('inactive');

Route::get('/validation/{email}/{token}', [ActivationTokenController::class, 'activate'])->name('activateToken');

Route::get('/validation/{email}/{token}/resend-token', [ActivationTokenController::class, 'resendToken'])->name('resendToken');

Route::middleware(['guest'])->group(function () {
    Route::get('/token-expired', function () {
        return view('token-expired');
    })->name('token-expired');

    Route::get('/token-activated', function () {
        return view('token-activated');
    })->name('token-activated');

    Route::get('/token-resend', function () {
        return view('token-resend');
    })->name('token-resend');
});

require __DIR__.'/auth.php';
