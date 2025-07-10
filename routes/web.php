<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EnrollmentController;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/view', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(fn() =>
    Route::resource('notifications', AdminNotificationController::class)->except(['show'])
 );

    Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('subjects', \App\Http\Controllers\SubjectController::class)->except(['show']);
    Route::resource('notifications', \App\Http\Controllers\Admin\AdminNotificationController::class)->except(['show']);
    });


    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
    Route::resource('grades', GradeController::class);
    Route::get('/student/grades', [App\Http\Controllers\GradeController::class, 'index'])->name('student.grades.index');
    Route::resource('subjects', SubjectController::class);
    Route::prefix('student')->as('student.')->group(function () {
        Route::resource('enrollments', EnrollmentController::class);
    });
});


require __DIR__ . '/auth.php';
