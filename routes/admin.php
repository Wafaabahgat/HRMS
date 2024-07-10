<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
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



Route::group(
    [
        // 'namespace' => 'Admin',
        'prefix' => 'admin',
        'middleware' => 'auth:admin'
    ],
    function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard'); //route
        Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    },
);


Route::group(
    [
        // 'namespace' => 'Admin',
        'prefix' => 'admin',
        'middleware' => 'guest:admin'
    ],
    function () {
        // login //
        Route::get('login', [
            LoginController::class, 'show_login_view'
        ])->name('admin.showlogin');

        Route::post('login', [
            LoginController::class, 'login'
        ])->name('admin.login');
    },

);

Route::fallback(
    function () {
        return redirect()->route('admin.showlogin');
    }
);