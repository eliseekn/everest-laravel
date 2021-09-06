<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;

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

Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('post/{post}', [PostController::class, 'show'])->name('post.show');

Route::middleware(['auth', 'role'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('dashboard/comments/{postId}', [DashboardController::class, 'comments'])->name('dashboard.comments');
    Route::get('dashboard/post/create', [DashboardController::class, 'create'])->name('post.create');
    Route::get('dashboard/post/edit/{post}', [DashboardController::class, 'edit'])->name('post.edit');

    Route::resource('post', PostController::class)->only(['store', 'destroy', 'update']);
    Route::resource('post.comment', CommentController::class)->only(['store', 'destroy']);
});
