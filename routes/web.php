<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
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

// Route::resource('users', UserController::class);

Route::post('/users', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/transactions', [UserController::class, 'index']);
Route::get('/show-deposits', [TransactionController::class, 'showDeposits'])->name('deposits')->middleware('auth');
Route::get('/showDepositForm', [TransactionController::class, 'showDepositForm'])->name('deposit')->middleware('auth');
Route::post('/deposit', [TransactionController::class, 'deposit'])->name('deposit')->middleware('auth');
Route::get('/show-withdrawals', [TransactionController::class, 'showWithdrawals'])->name('withdrawals.index');
Route::post('/withdrawal', [TransactionController::class, 'withdraw']);


require __DIR__.'/auth.php';
