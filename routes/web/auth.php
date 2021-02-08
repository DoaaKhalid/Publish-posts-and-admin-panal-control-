<?php
Route::middleware('auth')->group(function (){
    Route::get('/admin', [App\Http\Controllers\AdminsController::class, 'index'])->name('admin.index');
    Route::get('/admin/posts', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
    Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('role.index');
    Route::get('/permissions', [App\Http\Controllers\PermissionController::class, 'index'])->name('permission.index');
    Route::post('/posts/{post}', [App\Http\Controllers\CommentController:: class, 'store'])->name('comment.store');

    Route::post('/reply/store', [App\Http\Controllers\CommentController::class,'replyStore'])->name('reply.add');

    Route::delete('/posts/{comment}/destroy', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comment.destroy');


    Route::get('/admin/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    Route::post('/admin/posts', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    Route::get('/admin/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
    Route::patch('/admin/posts/{post}/update', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
    Route::delete('/admin/posts/{post}/destroy', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');

    Route::post('/roles', [App\Http\Controllers\RoleController::class, 'store'])->name('role.store');
    Route::delete('/roles/{role}/destroy', [App\Http\Controllers\RoleController::class, 'destroy'])->name('role.destroy');


    Route::patch('/admin/users/{user}/update', [App\Http\Controllers\UserController::class, 'update'])->name('users.profile.update');

    Route::delete('/admin/users/{user}/destroy', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/admin/animation', [App\Http\Controllers\UserController::class, 'animation'])->name('user.animation');
    Route::get('/admin/color', [App\Http\Controllers\UserController::class, 'color'])->name('user.color');
    Route::get('/admin/border', [App\Http\Controllers\UserController::class, 'border'])->name('user.border');

    Route::get('/admin/other', [App\Http\Controllers\UserController::class, 'other'])->name('user.other');
    Route::get('/admin/tables', [App\Http\Controllers\UserController::class, 'tables'])->name('user.tables');
    Route::get('/admin/charts', [App\Http\Controllers\UserController::class, 'charts'])->name('user.charts');

});
