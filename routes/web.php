<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SuperAdmin\SuperAdminUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissonController;
use Spatie\Permission\Models\Permission;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
});



// Route::middleware(['auth', 'role:Admin|Super Admin'])->group(function () {
//     // Route::get('/users/create', [UserManagementController::class, 'crecate'])->name('users.create');
//     // Route::post('/users', [UserManagementController::class, 'store'])->name('users.store');
// });




Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminUserController::class,'index'])->name('admin-dashboard');

    Route::post('admin/dashborad',[AdminUserController::class,'store'])->name('admin.users.store');
    Route::get('admin/dashborad/create',[AdminUserController::class,'create'])->name('admin.users.create');

});


Route::middleware(['auth', 'verified','role:Super Admin'])->group(function () {
    Route::get('/super-admin/dashboard', [SuperAdminUserController::class,'index'])->name('super-admin-dashboard');
    
    Route::post('super-admin/dashborad',[SuperAdminUserController::class,'store'])->name('super-admin.users.store');
    Route::get('super-admin/dashborad/create',[SuperAdminUserController::class,'create'])->name('super-admin.users.create');

    Route::resource('roles',RoleController::class);
    Route::resource('permissions',PermissonController::class);


    Route::post('users/{user}/edit', [SuperAdminUserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [SuperAdminUserController::class, 'update'])->name('users.update');
    Route::delete('user/{user}',[SuperAdminUserController::class,'delete'])->name('users.delete');


    // Route::get('/super-admin/users', [UserManagementController::class, 'index'])->name('super-admin.users.index');

    // Route::get('/super-admin/users/create', [UserManagementController::class, 'create'])->name('super-admin.users.create');

    // Route::post('/super-admin/users', [UserManagementController::class, 'store'])->name('super-admin.users.store');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
