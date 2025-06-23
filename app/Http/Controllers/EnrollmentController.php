<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    /**
     * Mostrar lista de matrículas do estudante autenticado.
     */
    public function index()
    {
        $enrollments = Enrollment::with('course')
            ->where('user_id', Auth::id())
            ->get();

        return view('student.enrollments.index', compact('enrollments'));
    }

    /**
     * Mostrar formulário para criar nova matrícula.
     */
    public function create()
    {
        $courses = Course::all();
        return view('student.enrollments.create', compact('courses'));
    }

    /**
     * Guardar nova matrícula.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        // Verificar se já está matriculado neste curso
        $exists = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $request->course_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors('Já estás matriculado neste curso.');
        }

        Enrollment::create([
            'user_id' => Auth::id(),
            'course_id' => $request->course_id,
        ]);

        return redirect()->route('student.enrollments.index')->with('success', 'Matrícula realizada com sucesso!');
    }

    /**
     * Mostrar detalhes de uma matrícula.
     */
    public function show($id)
    {
        $enrollment = Enrollment::with('course')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('student.enrollments.show', compact('enrollment'));
    }

    /**
     * Mostrar formulário para editar matrícula (se aplicável).
     */
    public function edit($id)
    {
        $enrollment = Enrollment::where('user_id', Auth::id())->findOrFail($id);
        $courses = Course::all();

        return view('student.enrollments.edit', compact('enrollment', 'courses'));
    }

    /**
     * Atualizar matrícula.
     */
    public function update(Request $request, $id)
    {
        $enrollment = Enrollment::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $enrollment->update([
            'course_id' => $request->course_id,
        ]);

        return redirect()->route('student.enrollments.index')->with('success', 'Matrícula atualizada com sucesso!');
    }

    /**
     * Apagar matrícula.
     */
    public function destroy($id)
    {
        $enrollment = Enrollment::where('user_id', Auth::id())->findOrFail($id);
        $enrollment->delete();

        return redirect()->route('student.enrollments.index')->with('success', 'Matrícula removida com sucesso!');
    }
}
