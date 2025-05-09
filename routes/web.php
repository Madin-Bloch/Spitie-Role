<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('role:User')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/events',[EventController::class,'index'])->name('events.index');
});



Route::middleware(['auth','role:Admin|Super Admin'])->group(function(){

    Route::resource('events', EventController::class);

});
Route::middleware('role:Admin')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['auth', 'verified'])->name('admin-dashboard');
});


Route::middleware('role:Super Admin')->group(function () {
    Route::get('/super-admin/dashboard', function () {
        return view('super-admin.dashboard');
    })->middleware(['auth', 'verified'])->name('super-admin-dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
