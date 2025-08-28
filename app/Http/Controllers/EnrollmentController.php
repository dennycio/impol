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
     * Guardar novas matrículas (múltiplos cursos).
     * O ano é definido automaticamente (1 → 4).
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_ids' => 'required|array',
            'course_ids.*' => 'exists:courses,id',
        ]);

        $userId = Auth::id();

        // Conta quantas matrículas já existem para este estudante
        $existingEnrollments = Enrollment::where('user_id', $userId)->count();

        // Define o próximo ano
        $year = $existingEnrollments + 1;

        // Impede matrícula além do 4º ano
        if ($year > 4) {
            return redirect()->route('student.enrollments.index')
                ->with('error', 'Já concluiu todas as matrículas (4 anos).');
        }

        foreach ($request->course_ids as $courseId) {
            $alreadyEnrolled = Enrollment::where('user_id', $userId)
                ->where('course_id', $courseId)
                ->where('year', $year)
                ->exists();

            if (!$alreadyEnrolled) {
                Enrollment::create([
                    'user_id'   => $userId,
                    'course_id' => $courseId,
                    'year'      => $year,
                ]);
            }
        }

        return redirect()->route('student.enrollments.index')
            ->with('success', "Matrícula realizada com sucesso para o {$year}º Ano!");
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
     * Mostrar formulário para editar matrícula.
     * (O estudante só pode alterar o curso, não o ano).
     */
    public function edit($id)
    {
        $enrollment = Enrollment::where('user_id', Auth::id())->findOrFail($id);
        $courses = Course::all();

        return view('student.enrollments.edit', compact('enrollment', 'courses'));
    }

    /**
     * Atualizar uma matrícula específica.
     * (Só pode alterar o curso, o ano permanece igual).
     */
    public function update(Request $request, $id)
    {
        $enrollment = Enrollment::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $enrollment->update([
            'course_id' => $request->course_id,
            // Não deixamos alterar o "year"
        ]);

        return redirect()->route('student.enrollments.index')
            ->with('success', 'Matrícula atualizada com sucesso!');
    }

    /**
     * Apagar matrícula.
     */
    public function destroy($id)
    {
        $enrollment = Enrollment::where('user_id', Auth::id())->findOrFail($id);
        $enrollment->delete();

        return redirect()->route('student.enrollments.index')
            ->with('success', 'Matrícula removida com sucesso!');
    }
}
