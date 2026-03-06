<?php

use App\Http\Controllers\Auth\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
})->middleware("auth");

Route::prefix('auth')->group(function(){
    Route::get("login", [AuthController::class, 'login'])->name("login")->middleware("guest");
    Route::post("login", [AuthController::class, 'authenticate'])->name("authenticate")->middleware("guest");

    Route::get("logout", [AuthController::class, 'logout'])->name("logout")->middleware("auth");

});
