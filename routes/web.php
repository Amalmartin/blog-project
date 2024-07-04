<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication routes
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/show', function () {
        return view('dashboard');
    })->name('posts.show');

    // Your existing authenticated routes here
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
    Route::get('/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [App\Http\Controllers\PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/posts/{post}/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
    Route::delete('/posts/{post}/comments/{comment}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/posts/{post}/comments/{comment}/edit', [App\Http\Controllers\CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/posts/{post}/comments/{comment}', [App\Http\Controllers\CommentController::class, 'update'])->name('comments.update');
});
