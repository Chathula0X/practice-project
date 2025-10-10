<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentContoller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\SupplierController;


Route::get('/', function () {
    return view('home');
})->name('welcome');

// Fortify Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

// Route::get('/student/all', function () {
//     return view('Student.index');
// });


Route::group(['prefix' => 'student'], function () {

    Route::get('/all', [StudentContoller::class, 'index'])->name('student.index');
    Route::get('/create', [StudentContoller::class, 'create'])->name('student.create');
    Route::post('/store', [StudentContoller::class, 'store'])->name('student.store');
    Route::get('/{student_id}/edit', [StudentContoller::class, 'edit'])->name('student.edit');
    Route::put('/{student_id}', [StudentContoller::class, 'update'])->name('student.update');
    Route::delete('/{student_id}', [StudentContoller::class, 'delete'])->name('student.delete');

});

Route::group(['prefix' => 'client'], function () {
    Route::get('/all', [ClientController::class, 'index'])->name('client.index');
});

Route::group(['prefix' => 'supplier'], function () {
    Route::get('/all', [SupplierController::class, 'index'])->name('supplier.index');
});

Route::middleware('guest:admins')->group(function () {

    Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'store'])->name('admin.login');

});


Route::middleware(['auth:admins'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    })->name('admin.dashboard');
    
    Route::post('/admin/logout', function () {
        Auth::guard('admins')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('admin.login');
    })->name('admin.logout');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

