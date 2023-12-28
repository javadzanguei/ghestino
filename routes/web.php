<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::post('/push',[PushController::class, 'store'])->middleware('auth:user');

Route::get('installment_payment', function() {
    return view('installment.index');
})->name('installment.index');

Route::middleware('guest')->get('', function() {
    return redirect()->route('installment.index');
})->name('index');

Route::prefix('auth')->middleware('guest')->get('', function () {
    return view('login');
})->name('auth');

Route::prefix('auth')->get('logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerate();
    return redirect()->route('installment.index');
})->name('auth.logout');

Route::prefix('user')->middleware('auth:user')->group(function () {
    Route::get('index', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('store', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::patch('update', [UserController::class, 'update'])->name('admin.user.update');
});

Route::prefix('installment-request')->middleware('auth:user')->group(function () {
    Route::get('index', function () {
        return view('admin.installment.index');
    })->name('admin.installment.index');
});
