<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('login', function () {
    return Auth::check() ? redirect('dashboard') : view('login');
});

Route::get('post/{post}', [PostController::class, 'show'])->name('post.show');

Route::middleware(['auth', 'role'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::resource('post', PostController::class)->only(['store', 'destroy', 'update']);
});
