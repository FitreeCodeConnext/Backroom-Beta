<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TerminalController;
use App\Http\Controllers\VendorController;
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

// Route::get('/', function () {
//     return view('login');
// });
// Route::get('/dashboard', function () {
//     return view('pages.dashboard');
// });

Route::get('/', [LoginController::class, 'index'])->name('root');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::group(['middleware' => 'auth.custom'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    // Terminal
    Route::get('/terminal', [TerminalController::class, 'index'])->name('terminal.index');
    Route::get('/terminal-show/{term_id}', [TerminalController::class, 'show'])->name('terminal-show');
    Route::put('/terminal-update/{term_id}', [TerminalController::class, 'update'])->name('terminal-update');
    Route::get('/export-csv', [TerminalController::class, 'export'])->name('export.csv');
    // Vendor 
    Route::get('/vendor', [VendorController::class, 'index'])->name('vendor.index');

    // Product
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');

});
