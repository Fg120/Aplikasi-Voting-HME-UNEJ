<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\KandidatController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SetupController;
use App\Http\Controllers\Admin\VotingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SendMailController;
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

Route::get('/home', function () {
    return redirect('/');
});

Route::get('/admin', function () {
    return redirect('/admin/dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::post('/submit', [HomeController::class, 'store'])->name('voting.store');

    Route::get('/logout', [AuthController::class, 'destroy'])->name('auth.logout');

    Route::middleware(['role:Superadmin|Admin'])->prefix('/admin')->name('admin.')->group(
        function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

            Route::prefix('/mahasiswa')->name('mahasiswa.')->group(
                function () {
                    Route::get('/', [MahasiswaController::class, 'index'])->name('index');
                    Route::get('/create', [MahasiswaController::class, 'create'])->name('create');
                    Route::post('/create', [MahasiswaController::class, 'store'])->name('store');
                    Route::get('/edit/{id}', [MahasiswaController::class, 'edit'])->name('edit');
                    Route::post('/update/{id}', [MahasiswaController::class, 'update'])->name('update');
                    Route::get('/show/{id}', [MahasiswaController::class, 'show'])->name('show');
                    Route::delete('/destroy/{id}', [MahasiswaController::class, 'destroy'])->name('destroy');
                    Route::get('/send-token/{id}', [MahasiswaController::class, 'send_token'])->name('send_token');
                }
            );

            Route::prefix('/admin')->name('admin.')->group(
                function () {
                    Route::get('/', [AdminController::class, 'index'])->name('index');
                    Route::get('/create', [AdminController::class, 'create'])->name('create');
                    Route::post('/create', [AdminController::class, 'store'])->name('store');
                    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
                    Route::post('/update/{id}', [AdminController::class, 'update'])->name('update');
                    Route::get('/show/{id}', [AdminController::class, 'show'])->name('show');
                    Route::delete('/destroy/{id}', [AdminController::class, 'destroy'])->name('destroy');
                }
            );
            Route::prefix('/kandidat')->name('kandidat.')->group(
                function () {
                    Route::get('/', [KandidatController::class, 'index'])->name('index');
                    Route::get('/create', [KandidatController::class, 'create'])->name('create');
                    Route::post('/create', [KandidatController::class, 'store'])->name('store');
                    Route::get('/edit/{id}', [KandidatController::class, 'edit'])->name('edit');
                    Route::post('/update/{id}', [KandidatController::class, 'update'])->name('update');
                    Route::get('/show/{id}', [KandidatController::class, 'show'])->name('show');
                    Route::delete('/destroy/{id}', [KandidatController::class, 'destroy'])->name('destroy');
                }
            );
            Route::prefix('/voting')->name('voting.')->group(
                function () {
                    Route::get('/monitor', [VotingController::class, 'monitor'])->name('monitor');
                }
            );

            Route::prefix('/export')->name('export.')->group(function () {
                Route::get('/', [ExportController::class, 'index'])->name('index');
                Route::get('/user-all', [ExportController::class, 'user_all'])->name('user_all');
                Route::get('/user-umum', [ExportController::class, 'user_umum'])->name('user_umum');
                Route::get('/user-admin', [ExportController::class, 'user_admin'])->name('user_admin');
                Route::get('/user-unvote', [ExportController::class, 'user_unvote'])->name('user_unvote');
                Route::get('/user-voted', [ExportController::class, 'user_voted'])->name('user_voted');
                Route::get('/log-voting', [ExportController::class, 'log_voting'])->name('log_voting');
            });


            Route::prefix('/setting')->name('setting.')->group(
                function () {
                    Route::get('/', [SettingController::class, 'setting'])->name('index');
                    Route::post('/enable/{id}', [SettingController::class, 'enable'])->name('voting.enable');
                    Route::post('/disable/{id}', [SettingController::class, 'disable'])->name('voting.disable');
                    Route::post('/schedule', [SettingController::class, 'schedule'])->name('voting.schedule');
                }
            );
        }
    );
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('auth.store');
    Route::get('/reload-captcha', [AuthController::class, 'reloadCaptcha']);
});

Route::get('/403', [ErrorController::class, 'error403'])->name('403');
Route::get('/setup', [SetupController::class, 'setup']);
