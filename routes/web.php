<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CalonAdminController;
use App\Http\Middleware\Authorize;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.public.dashboard');
})->middleware("auth");

Route::prefix('auth')->group(function(){
    Route::get("login", [AuthController::class, 'login'])->name("login")->middleware("guest");
    Route::post("login", [AuthController::class, 'authenticate'])->name("authenticate")->middleware("guest");

    Route::get("logout", [AuthController::class, 'logout'])->name("logout")->middleware("auth");

});

    Route::prefix("/admin")->group(function(){
        Route::get("/", [AdminController::class, 'index'])->name("admin.dashboard");
        Route::resource("camin", CalonAdminController::class);
    })->middleware("auth", Authorize::class);
