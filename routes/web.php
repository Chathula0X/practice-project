<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentContoller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('welcome');

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
    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    })->name('admin.dashboard');
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

