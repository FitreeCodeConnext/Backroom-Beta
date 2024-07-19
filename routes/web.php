<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentGroupController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGroupController;
use App\Http\Controllers\ProductSapController;
use App\Http\Controllers\ProductUnitController;
use App\Http\Controllers\TerminalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorGroupController;
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
    Route::resource('/terminal', TerminalController::class,);
    Route::get('/export-csv', [TerminalController::class, 'export'])->name('export.csv');
    // Vendor 
    Route::resource('/vendor', VendorController::class);
    Route::resource('/vendor-group', VendorGroupController::class);

    // Product
    Route::resource('/product', ProductController::class);
    Route::resource('/productgroup', ProductGroupController::class);
    Route::resource('/product-unit', ProductUnitController::class);
    Route::resource('/product-sap', ProductSapController::class);
    
    // Payment
    Route::resource('/payment-group', PaymentGroupController::class);

    // User
    Route::resource('/user', UserController::class);

});
