<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FutsalController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('/home', [FutsalController::class, 'home'])->name('homeFutsal');
Route::get('/find', [FutsalController::class, 'find'])->name('findViewFutsal');
Route::post('/find', [FutsalController::class, 'checkFind'])->name('checkFind');
Route::post('/booking', [FutsalController::class, 'checkBooking'])->name('checkBooking');
Route::get('/daftarbooking', [FutsalController::class, 'daftarbooking'])->name('daftarbooking');
Route::get('/riwayattransaksi', [FutsalController::class, 'riwayattransaksi'])->name('riwayattransaksi');
Route::get('/daftarlapangan', [FutsalController::class, 'daftarlapangan'])->name('daftarlapangan');
