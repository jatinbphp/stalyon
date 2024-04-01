<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminWeb\AdminAuthController;
use App\Http\Controllers\AdminWeb\DashboardController;
use App\Http\Controllers\AdminWeb\AgentController;
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

Route::get('/test', function () {
    return view('admin.auth.admin_login');
});


Route::get('/admin', [AdminAuthController::class, 'adminLoginForm'])->name('admin.login');
Route::post('/adminLogin', [AdminAuthController::class, 'adminLogin'])->name('admin.signin');

Route::prefix('admin')->middleware(['admin_web'])->group(function () {
//dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

//login
Route::get('logout', [AdminAuthController::class, 'adminLogout'])->name('admin.logout');

//user
Route::resource('agents', AgentController::class);
});