<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Subject;
use App\Models\Notification;
use PDF;

class PdfExportController extends Controller
{
    /**
     * Exportar Matrículas
     */
    public function enrollments()
    {
        $enrollments = Enrollment::with('user', 'subject')->get();
        $pdf = PDF::loadView('admin.pdf.enrollments', compact('enrollments'));
        return $pdf->download('matriculas.pdf');
    }

    /**
     * Exportar Estudantes
     */
    public function students()
    {
        $students = User::where('role', 'student')->get();
        $pdf = PDF::loadView('admin.pdf.students', compact('students'));
        return $pdf->download('estudantes.pdf');
    }

    /**
     * Exportar Professores
     */
    public function teachers()
    {
        $teachers = User::where('role', 'teacher')->get();
        $pdf = PDF::loadView('admin.pdf.teachers', compact('teachers'));
        return $pdf->download('professores.pdf');
    }

    /**
     * Exportar Disciplinas
     */
    public function subjects()
    {
        $subjects = Subject::all();
        $pdf = PDF::loadView('admin.pdf.subjects', compact('subjects'));
        return $pdf->download('disciplinas.pdf');
    }

    /**
     * Exportar Notificações
     */
    public function notifications()
    {
        $notifications = Notification::all();
        $pdf = PDF::loadView('admin.pdf.notifications', compact('notifications'));
        return $pdf->download('notificacoes.pdf');
    }
}
