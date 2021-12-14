<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('index')->middleware('auth');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Account routes
Route::prefix('accounts')->group(function() {
    Route::get('/all', [AccountController::class, 'listAccounts'])->name('listAccounts');
    Route::get('/detail/{id}', [AccountController::class, 'accountDetail'])->name('accountDetail');
    Route::post('/add', [AccountController::class, 'addAccount'])->name('addAccount');
    Route::get('/{id}/add-transaction', [AccountController::class, 'addTransaction'])->name('addTransaction');
    Route::post('/add-transaction-done', [AccountController::class, 'addTransactionDone'])->name('addTransactionDone');
});
