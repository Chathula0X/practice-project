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
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ItineraryController;




Route::get('/', function () {
    return view('welcome');
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
    Route::post('/admin/login', [AdminController::class, 'store'])->name('admin.login.store');
});

Route::middleware(['auth:admins'])->group(function () {
    Route::get('/admin/DashboardHome', function () {
        return view('admin-dashboard.dashboard-home.index');
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

//inquiry routes
Route::group(['prefix' => 'inquiry'], function(){
    Route::get('/{client_id}', [InquiryController::class, 'index'])->name('inquiry.index');
    Route::get('/{client_id}/create', [InquiryController::class, 'create'])->name('inquiry.create');
    Route::post('/{client_id}/store', [InquiryController::class, 'store'])->name('inquiry.store');
    Route::get('/{inquiry_id}/edit', [InquiryController::class, 'edit'])->name('inquiry.edit');
    Route::put('/{inquiry_id}', [InquiryController::class, 'update'])->name('inquiry.update');
    Route::delete('/{inquiry_id}', [InquiryController::class, 'delete'])->name('inquiry.delete');
});

//itinerary routes
Route::group(['prefix' => 'itinerary'], function(){
    Route::get('/inquiry/{inquiry_id}', [ItineraryController::class, 'index'])->name('itinerary.index');
    Route::get('/inquiry/{inquiry_id}/create', [ItineraryController::class, 'create'])->name('itinerary.create');
    Route::post('/inquiry/{inquiry_id}/store', [ItineraryController::class, 'store'])->name('itinerary.store');
    Route::get('/{id}/edit', [ItineraryController::class, 'edit'])->name('itinerary.edit');
    Route::patch('/{id}/status', [ItineraryController::class, 'updateStatus'])->name('itinerary.update-status');
    Route::get('/{id}', [ItineraryController::class, 'show'])->name('itinerary.show');
    Route::put('/{id}', [ItineraryController::class, 'update'])->name('itinerary.update');
    Route::delete('/{id}', [ItineraryController::class, 'delete'])->name('itinerary.delete');
});



Route::middleware('auth')->group(function () {
    // User dashboard route - matches LoginResponse and RegisterResponse redirects
    Route::get('/user-dashboard', function () {
        return view('user-dashboard.user-dashboard');
    })->name('user-dashboard.index');
    
    // Dashboard route for backwards compatibility (tests expect this)
    Route::get('/dashboard', function () {
        return view('user-dashboard.user-dashboard');
    })->name('dashboard');
    
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/DashboardHome', function () {
        return redirect()->route('welcome');
    })->name('DashboardHome.index');
});

