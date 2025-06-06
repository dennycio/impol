<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\DashboardController as AdminDashboardController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;

Route::get('/', function () {
  return redirect()->route('login');
});

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
   Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
});
Route::middleware(['auth', 'role:admin'])->group(function () {
  // Rotas de admin 
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
 
  //rotas de professor
});

Route::middleware(['auth', 'role:student'])->group(function () {
 
  // rotas de estudante
});

require __DIR__ . '/auth.php';
