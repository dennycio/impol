<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Course;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Mostrar lista de disciplinas.
     */
    public function index()
    {
        $subjects = Subject::with('course')->get();
        return view('subjects.index', compact('subjects'));
    }

    /**
     * Mostrar formulário para criar disciplina.
     */
    public function create()
    {
        $courses = Course::all();
        return view('subjects.create', compact('courses'));
    }

    /**
     * Guardar disciplina no banco de dados.
     */
    use App\Models\SubjectEnrollment;
use Illuminate\Support\Facades\Auth;

public function store(Request $request)
{
    $request->validate([
        'subject_ids' => 'required|array',
        'subject_ids.*' => 'exists:subjects,id',
        'year' => 'required|integer|min:1|max:5',
    ]);

    $userId = Auth::id();
    $year = $request->year;

    foreach ($request->subject_ids as $subjectId) {
        $alreadyEnrolled = SubjectEnrollment::where('user_id', $userId)
            ->where('subject_id', $subjectId)
            ->where('year', $year)
            ->exists();

        if (!$alreadyEnrolled) {
            SubjectEnrollment::create([
                'user_id' => $userId,
                'subject_id' => $subjectId,
                'year' => $year,
            ]);
        }
    }

    return redirect()->route('student.enrollments.index')->with('success', 'Disciplinas adicionadas com sucesso!');
}


    /**
     * Mostrar detalhes de uma disciplina específica.
     */
    public function show($id)
    {
        $subject = Subject::with('course')->findOrFail($id);
        return view('subjects.show', compact('subject'));
    }

    /**
     * Mostrar formulário para editar disciplina.
     */
    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $courses = Course::all();
        return view('subjects.edit', compact('subject', 'courses'));
    }

    /**
     * Atualizar disciplina no banco de dados.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
        ]);

        $subject = Subject::findOrFail($id);
        $subject->update([
            'name' => $request->name,
            'course_id' => $request->course_id,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Disciplina atualizada com sucesso!');
    }

    /**
     * Remover disciplina do banco de dados.
     */
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('subjects.index')->with('success', 'Disciplina removida com sucesso!');
    }
}
