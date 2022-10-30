<?php

use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Member\RegisterController;
use App\Http\Controllers\Member\LoginController as MemberLoginController;
use App\Http\Controllers\Member\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() { return view('index'); });

// gate member/user
Route::get('register', [RegisterController::class, 'index'])->name('member.register');
Route::post('register', [RegisterController::class, 'store'])->name('member.register.store');
Route::get('login', [MemberLoginController::class, 'index'])->name('member.login');
Route::post('login', [MemberLoginController::class, 'auth'])->name('member.login.auth');

// group member
Route::group(['prefix' => 'member'], function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('member.dashboard');
    Route::get('logout', [MemberLoginController::class, 'logout'])->name('member.logout');
});

// gate admin
Route::get('admin/login', [AdminLoginController::class, 'index'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'authenticate'])->name('admin.login.auth');

// group admin
Route::group(['prefix' => 'admin', 'middleware' => ['admin.auth']], function () {
    Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    Route::view('/', 'admin.dashboard')->name('admin.dashboard');

    // gorup transactions
    Route::group(['prefix' => 'transaction'], function () {
        Route::get('/', [TransactionController::class, 'index'])->name('admin.transactions');
    });

    // group movie
    Route::group(['prefix' => 'movie'], function () {
        Route::get('/', [MovieController::class, 'index'])->name('admin.movies');
        Route::get('/create', [MovieController::class, 'create'])->name('admin.movies.create');
        Route::post('/store', [MovieController::class, 'store'])->name('admin.movies.store');
        Route::get('/edit/{id}', [MovieController::class, 'edit'])->name('admin.movies.edit');
        Route::put('/update/{id}', [MovieController::class, 'update'])->name('admin.movies.update');
        Route::delete('/delete/{id}', [MovieController::class, 'destroy'])->name('admin.movies.delete');
    });

    // Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
    // Route::resource('movies', 'Admin\MovieController');
    // Route::resource('genres', 'Admin\GenreController');
    // Route::resource('users', 'Admin\UserController');
});
