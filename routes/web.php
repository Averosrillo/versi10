<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;

Route::get('/', function () {
    return view('login');
});

Auth::routes(); 

Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('user', UserController::class);

Route::post('/topUp', [WalletController::class, 'topup'])->name('topUp');
Route::post('/acceptRequest', [WalletController::class, 'acceptRequest'])->name('acceptRequest');
Route::post('/withdraw', [WalletController::class, 'withdraw'])->name('withdraw');
Route::post('/transfer', [WalletController::class, 'transfer'])->name('transfer');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/add-user', [UserController::class, 'create'])->name('add-user');
Route::post('/add-user', [UserController::class, 'store'])->name('store-user');
    Route::get('edit-user/{user}', [UserController::class, 'edit'])->name('edit-user');
    Route::put('update-user/{user}', [UserController::class, 'update'])->name('update-user');
    Route::delete('delete-user/{user}', [UserController::class, 'destroy'])->name('delete-user');
});

Route::post('/approve/{wallet}', [WalletController::class, 'acceptRequest'])
    ->name('approve')
    ->middleware('role:bank');

Route::post('/reject/{wallet}', [WalletController::class, 'rejectRequest'])
    ->name('reject')
    ->middleware('role:bank'); 

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/mutasi', [WalletController::class, 'allMutasi'])->name('mutasi.index')->middleware('auth');

Route::get('/all-transaction', [WalletController::class, 'all'])->name('wallet.all');
Route::post('/bank/topup', [WalletController::class, 'bankTopupToSiswa'])->name('bank.topup');
Route::post('/bank/withdraw', [WalletController::class, 'bankWithdrawFromSiswa'])->name('bank.withdraw');
Route::get('/wallet/export-pdf', [WalletController::class, 'exportPDF'])->name('export.pdf');
Route::get('/wallet/export-my-pdf', [WalletController::class, 'exportMyPDF'])->name('export.pdf.student');


