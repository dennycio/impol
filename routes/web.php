<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboard;
use App\Http\Controllers\Student\DashboardController as StudentDashboard;



Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboard::class, 'index'])->middleware('role:admin')->name('admin.dashboard');
    Route::get('/teacher/dashboard', [TeacherDashboard::class, 'index'])->middleware('role:teacher')->name('teacher.dashboard');
    Route::get('/student/dashboard', [StudentDashboard::class, 'index'])->middleware('role:student')->name('student.dashboard');
});


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Exemplo de dashboards
Route::get('/admin/dashboard', fn() => 'Painel do Administrador')->middleware('auth');
Route::get('/teacher/dashboard', fn() => 'Painel do Professor')->middleware('auth');
Route::get('/student/dashboard', fn() => 'Painel do Estudante')->middleware('auth');
