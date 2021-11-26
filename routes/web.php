<?php

use App\Http\Controllers\AccountController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('index');
})->name('index');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Account routes
Route::prefix('accounts')->group(function() {
    Route::get('/all', [AccountController::class, 'listAccounts'])->name('listAccounts');
    Route::get('/detail/{id}', [AccountController::class, 'accountDetail'])->name('accountDetail');
    Route::post('/add', [AccountController::class, 'addAccount'])->name('addAccount');
});
