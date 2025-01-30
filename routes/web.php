<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StudentController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/register-student', [StudentController::class, 'registerStudent']);
    Route::get('/attendance', [AttendanceController::class, 'index']);
    Route::get('/attendance/check/{studentId}', [AttendanceController::class, 'attendance']);
    Route::get('/student/{stud_id}', [StudentController::class, 'getStudent']);
    Route::get('/students/archive/{stud_id}', [StudentController::class, 'archive']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

require __DIR__.'/auth.php';
