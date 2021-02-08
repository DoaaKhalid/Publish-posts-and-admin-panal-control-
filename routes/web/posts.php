<?php
Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('blog-post');
