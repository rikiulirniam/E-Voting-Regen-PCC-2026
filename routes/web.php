<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CalonAdminController;
use App\Http\Controllers\PesertaController;
use App\Http\Middleware\Authorize;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('pages.public.voting');
// })->middleware("auth")->name('dashboard');
Route::get('/', [CalonAdminController::class, 'camin'])->middleware('auth')->name('dashboard');

Route::get('/confirm', function () {
    return view('pages.public.confirm');
})->middleware('auth');

Route::prefix('auth')->group(function(){
    Route::get("login", [AuthController::class, 'login'])->name("login")->middleware("guest");
    Route::post("login", [AuthController::class, 'authenticate'])->name("authenticate")->middleware("guest");

    Route::get("logout", [AuthController::class, 'logout'])->name("logout")->middleware("auth");
});

Route::prefix("/admin")->group(function () {
    Route::get("/", [AdminController::class, 'index'])->name("admin.dashboard");
    Route::get('/display', [AdminController::class, 'display'])->name('admin.display');

    Route::resource("camin", CalonAdminController::class);

    Route::get("peserta/template", [PesertaController::class, 'downloadTemplate'])->name("peserta.template");
    Route::get("peserta/export", [PesertaController::class, 'export'])->name("peserta.export");
    Route::post("peserta/{peserta}/send-credentials", [PesertaController::class, 'sendCredentials'])->name("peserta.send-credentials");
    Route::resource("peserta", PesertaController::class)->except(['show'])->parameters(['peserta' => 'peserta']);
})->middleware("auth", Authorize::class);
