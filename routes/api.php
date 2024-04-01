<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthorizationController;
use App\Http\Controllers\Admin\AgentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Admin Auth
Route::post('admin-register',[AuthorizationController::class,'adminRegister'])->name('admin.register');
Route::post('admin-login',[AuthorizationController::class,'adminLogin'])->name('admin.login');
Route::post('forgot-password',[AuthorizationController::class,'forgotPassword'])->name('forgot.password');

Route::prefix('admin')->middleware(['admin'])->group(function () {
    // Admin logout
    Route::post('logout',[AuthorizationController::class,'adminLogout'])->name('admin.logout');
    //test
    Route::post('test',[AuthorizationController::class,'test'])->name('test');
    //Agent
    Route::post('add-agent',[AgentController::class,'addAgent'])->name('add.agent');
    Route::post('agent-list',[AgentController::class,'agentList'])->name('agent.list');
    Route::post('remove-agent',[AgentController::class,'removeAgent'])->name('remove.agent');
});