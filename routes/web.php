<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Client\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
Route::get('/', [MainController::class, 'index'])->name('admin');

Route::get('/loginn', [LoginController::class, 'index'])->name('login');
Route::post('loginn', [LoginController::class, 'login']);
Route::post('logoutt', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('/book',[BookController::class,'index']);
Route::get('/indexer',[UserController::class,'index']);
Route::post('/adduser',[UserController::class,'create']);
Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('main', [MainController::class, 'index']);



        # Menus
        Route::prefix('menus')->group(function () {
            Route::get('add', [MenuController::class, 'create']);
            Route::post('add', [MenuController::class, 'store']);
            Route::get('list', [MenuController::class, 'index']);
            Route::get('search', [MenuController::class, 'search'])->name('menu.search');
            Route::get('edit/{menu}', [MenuController::class, 'show']);
            Route::post('edit/{menu}', [MenuController::class, 'update']);
            Route::get('destroy/{id}', [MenuController::class, 'destroy']);

        });
        Route::prefix('users')->group(function () {
            Route::get('usermana',[UserController::class,'create']);
            Route::get('add',[UserController::class,'store']);
        });




    });
});
//
Route::get('client/index', [LoginController::class, 'indexclient']);

        # Menu
//Route::get('client/index', [LoginController::class, 'indexclient']);
