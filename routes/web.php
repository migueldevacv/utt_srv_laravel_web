<?php

use App\Events\QrScannerEvent;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\VerificationCodeController;
use Illuminate\Http\Request;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'code_verified', 'qr_verified'])->name('dashboard');

Route::get('/catalogos', function () {
    return view('Dashboard/catalog');
})->middleware(['auth', 'verified', 'code_verified', 'qr_verified'])->name('catalogos');

Route::middleware(['auth', 'code_verified', 'qr_verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// CODIGOS DE VERIFICACION
Route::middleware(['auth'])->get('/verify_code', [VerificationCodeController::class, 'store'])->name('verify_code'); // Esta es la vista donde ingresas el codigo
Route::middleware(['auth'])->post('/validate/login/code', [VerificationCodeController::class, 'validate_code_login'])->name('last_code'); // Esta ruta es la que valida el codigo web

Route::get('/code', [VerificationCodeController::class, 'show'])->middleware('signed')->name('show_code'); // Esta es la vista que genera el mail

Route::middleware(['auth'])->get('/qrcode', [QrCodeController::class, 'show'])->name('qr_code'); // Esta ruta es la que muestra el qr en web
Route::get('/qrcode/verified', [QrCodeController::class, 'qr_verified'])->name('qr_verified'); // Esta ruta es la que valida el codigo web




require __DIR__.'/auth.php';
