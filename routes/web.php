<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;

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
Route::get('dashboard', [DashboardController::class, 'index']);
Route::get('daftarKendaraan', [DashboardController::class, 'daftarKendaraan']);
Route::group(['prefix' => 'user'], function () {
    Route::get('/login', [UserController::class, 'view_login']);
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/logout', [UserController::class, 'logout']);
});

Route::middleware(['approver'])->group(function () {
    Route::get('/approvalPage', [BookingController::class, 'approvalPage']);
    Route::get('/approve/{id}', [BookingController::class, 'approve']);
    Route::get('/decline/{id}', [BookingController::class, 'decline']);

});

Route::middleware(['admin'])->group(function () {
    Route::get('/formBook', [BookingController::class, 'form']);
    Route::post('/addBook', [BookingController::class, 'addBook']);
    Route::get('getApprover/{id}', [BookingController::class, 'getApprover']);
    // Route::get('getDriver/{start}/{end}', [BookingController::class, 'getDriver']);
    // Route::post('/getDriver', [BookingController::class, 'getDriver']);
});