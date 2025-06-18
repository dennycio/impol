<?php
namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    // Mostrar todas as notas (para professor)
    public function index()
    {
        $grades = Grade::with(['student', 'subject'])->get();
        return view('grades.index', compact('grades'));
    }

    // Formulário para criar nota
    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();
        return view('grades.create', compact('students', 'subjects'));
    }

    // Guardar nota
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'subject_id' => 'required',
            'grade' => 'required|numeric',
        ]);

        Grade::create($request->all());

        return redirect()->route('grades.index')->with('success', 'Nota adicionada!');
    }

    // Editar nota
    public function edit(Grade $grade)
    {
        $students = Student::all();
        $subjects = Subject::all();
        return view('grades.edit', compact('grade', 'students', 'subjects'));
    }

    // Actualizar nota
    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'student_id' => 'required',
            'subject_id' => 'required',
            'grade' => 'required|numeric',
        ]);

        $grade->update($request->all());

        return redirect()->route('grades.index')->with('success', 'Nota actualizada!');
    }

    // Apagar nota
    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Nota removida!');
    }

    // Estudante vê as suas notas
    public function studentGrades()
    {
        $grades = Grade::where('student_id', auth()->user()->student->id)
            ->with('subject')
            ->get();

        return view('grades.student', compact('grades'));
    }
}
