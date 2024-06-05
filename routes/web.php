<?php

use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\IdeaController as AdminIdeaController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Database\Query\IndexHint;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route::group(['prefix' => 'idea/', 'as' => 'idea.'], function () {
//     Route::get('/{idea}', [IdeaController::class, 'show'])->name('show');
//     Route::post('', [IdeaController::class, 'store'])->name('create');

//     Route::group(['middleware' => ['auth']], function () {
//         Route::get('/{idea}/edit', [IdeaController::class, 'edit'])->name('edit');
//         Route::put('/{idea}', [IdeaController::class, 'update'])->name('update');
//         Route::delete('/{idea}', [IdeaController::class, 'destroy'])->name('destroy');

//         Route::post('/{idea}/comments', [CommentController::class, 'store'])->name('comment.store');
//     });
// });

Route::resource('idea', IdeaController::class)
    ->except(['index', 'create', 'show'])
    ->middleware('auth');
Route::resource('idea', IdeaController::class)->only(['show']);
Route::resource('idea.comment', CommentController::class)
    ->only(['store'])
    ->middleware('auth');

Route::resource('users', UserController::class)->only('show');
Route::resource('users', UserController::class)
    ->only('update', 'edit')
    ->middleware('auth');

Route::get('/profile', [UserController::class, 'profile'])
    ->middleware('auth')
    ->name('profile');

Route::group(['middleware' => ['guest']], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store']);
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('users/{user}/follow', [FollowerController::class, 'follow'])
    ->middleware('auth')
    ->name('users.follow');
Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])
    ->middleware('auth')
    ->name('users.unfollow');

Route::post('users/{idea}/like', [IdeaLikeController::class, 'like'])
    ->middleware('auth')
    ->name('ideas.like');
Route::post('ideas/{idea}/unlike', [IdeaLikeController::class, 'unlike'])
    ->middleware('auth')
    ->name('ideas.unlike');

Route::get('/feed', FeedController::class)
    ->middleware('auth')
    ->name('feed');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::middleware(['auth', 'can:admin'])
    ->prefix('/admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', AdminUserController::class)->only('index');
        Route::resource('ideas', AdminIdeaController::class)->only('index');
        Route::resource('comments', AdminCommentController::class)->only('index', 'destroy');
    });

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
