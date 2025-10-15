<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentContoller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use App\Models\Client;
use App\Models\Supplier;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ClientControllerc;
use App\Http\Controllers\SupplierControllers;




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

Route::middleware('guest:admins')->group(function () {
    Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:admins'])->group(function () {
    Route::get('/admin/DashboardHome', function () {
        return view('AdminDashboard.DashboardHome.index');
    })->name('admin.dashboard');
    
    Route::post('/admin/logout', function () {
        Auth::guard('admins')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('admin.login');
    })->name('admin.logout');
    
    // Client routes
    Route::group(['prefix' => 'client'], function (){
        Route::get('/all', [ClientControllerc::class, 'index'])->name('client.index');
        Route::get('/create', [ClientControllerc::class, 'create'])->name('client.create');
        Route::post('/store', [ClientControllerc::class, 'store'])->name('client.store');
        Route::get('/{client_id}/edit', [ClientControllerc::class, 'edit'])->name('client.edit');
        Route::put('/{client_id}', [ClientControllerc::class, 'update'])->name('client.update');
        Route::delete('/{client_id}', [ClientControllerc::class, 'delete'])->name('client.delete');
    });
    
    // Supplier routes
    Route::group(['prefix' => 'supplier'], function () {
        Route::get('/all', [SupplierControllers::class, 'index'])->name('supplier.index');
        Route::get('/create', [SupplierControllers::class, 'create'])->name('supplier.create');
        Route::post('/store', [SupplierControllers::class, 'store'])->name('supplier.store');
        Route::get('/{supplier_id}/edit', [SupplierControllers::class, 'edit'])->name('supplier.edit');
        Route::put('/{supplier_id}', [SupplierControllers::class, 'update'])->name('supplier.update');
        Route::delete('/{supplier_id}', [SupplierControllers::class, 'delete'])->name('supplier.delete');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('AdminDashboard.DashboardHome.index');
    })->name('dashboard');
    
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/DashboardHome', function () {
        return view('AdminDashboard.DashboardHome.index');
    })->name('DashboardHome.index');
});

