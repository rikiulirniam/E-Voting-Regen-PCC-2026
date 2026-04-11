<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CalonAdminController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PesertaController;
use App\Http\Middleware\Authorize;
use App\Models\User;
use Illuminate\Support\Facades\Route;

//
Route::get('/media/{path}', [MediaController::class, 'show'])
    ->where('path', '.*')
    ->name('media.show');

Route::get('/', [CalonAdminController::class, 'camin'])
    ->middleware(['auth', 'nocache', 'peserta.not_voted'])
    ->name('dashboard');

Route::get('/vote-in', [CalonAdminController::class, 'vote_in_fallback'])
    ->middleware(['auth', 'nocache']);

Route::post('/vote-in', [CalonAdminController::class, 'vote_in'])
    ->middleware(['auth', 'nocache', 'peserta.not_voted'])
    ->name('vote-in-submit');

Route::get('/vote-in/success', [CalonAdminController::class, 'vote_in_success'])
    ->middleware(['auth', 'nocache'])
    ->name('vote-in.success');

Route::prefix('auth')->group(function(){
    Route::get("login", [AuthController::class, 'login'])->name("login")->middleware("guest");
    Route::post("login", [AuthController::class, 'authenticate'])->name("authenticate")->middleware("guest");

    Route::get("logout", [AuthController::class, 'logout'])->name("logout")->middleware(["auth", "nocache"]);
});

Route::middleware(["auth", "nocache", Authorize::class])->prefix('/admin')->group(function () {
    Route::get("/", [AdminController::class, 'index'])->name("admin.dashboard");
    Route::get('/display', [AdminController::class, 'display'])->name('admin.display');
    Route::get('/display/stats', [AdminController::class, 'displayStats'])->name('admin.display.stats');
    Route::get('/pemenang', [AdminController::class, 'pemenang'])->name('admin.pemenang');

    Route::resource("camin", CalonAdminController::class);

    Route::get("peserta/template", [PesertaController::class, 'downloadTemplate'])->name("peserta.template");
    Route::get("peserta/export", [PesertaController::class, 'export'])->name("peserta.export");
    Route::post("peserta/import-vote-results", [PesertaController::class, 'importVoteResults'])->name("peserta.import-vote-results");
    Route::delete("peserta", [PesertaController::class, 'destroyAll'])->name("peserta.destroy-all");
    Route::post("peserta/{peserta}/send-credentials", [PesertaController::class, 'sendCredentials'])->name("peserta.send-credentials");
    Route::resource("peserta", PesertaController::class)->except(['show'])->parameters(['peserta' => 'peserta']);
});
