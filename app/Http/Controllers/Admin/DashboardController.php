<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\Subject;
use App\Models\Notification;

class DashboardController extends Controller
{
    public function index()
    {
        // Contar todos os estudantes (com role = 'student')
        $activeStudents = User::where('role', 'student')->count();

        // Contar todos os professores (com role = 'teacher')
        $teachers = User::where('role', 'teacher')->count();

        // Contar todas as matrículas
        $enrollments = Enrollment::count();
        // Contar todas as disciplinas
        $subjects = Subject::count();
        $notifications = Notification::latest()->take(5)->get();

        return view('admin.dashboard', compact('activeStudents', 'teachers', 'enrollments', 'subjects', 'notifications'));
    }
}
