<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CreateVerificationController;
use App\Http\Controllers\Manage2FAController;

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
    return view('login');
});
Route::post('login', [UserController::class, 'login'])->name('login');
Route::get('logout', [UserController::class, 'logout'])->name('logout');;

Route::get('verify', [UserController::class, 'verify_view']);
Route::post('verify', [UserController::class, 'verify'])->name('verify');

Route::get('/dashboard', function () {
    return view('dashboard');
});


Route::get('/settings', function () {
    return view('settings');
})->name('settings');

Route::get('/manage2FA', function () {
    return view('manage2FA');
});

//Route::get('/2fa-verification', function () {
//    return view('2fa-verification');
//});


Route::get('manage2FA', [Manage2FAController::class, 'create'])->name('2fa-setting');
Route::post('manage2FA', [Manage2FAController::class, 'store']);

Route::get('register', [RegisterController::class, 'create']);
Route::post('register', [RegisterController::class, 'store']);

Route::get('2fa-verification', [CreateVerificationController::class, 'create']);
Route::post('2fa-verification', [CreateVerificationController::class, 'store']);
