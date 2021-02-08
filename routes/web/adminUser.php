<?php

use Illuminate\Support\Facades\Route;
Route::middleware(['role:Admin','auth'])->group(function (){
    Route::get('/admin/users', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::Put('/admin/{user}/attach', [App\Http\Controllers\UserController::class, 'attach'])->name('user.role.attach');
    Route::delete('/admin/{user}/detach', [App\Http\Controllers\UserController::class, 'detach'])->name('user.role.detach');

});
