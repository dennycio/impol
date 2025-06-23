<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\User;
use App\Models\Subject;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    // Mostrar todas as notas (apenas professores)
    public function index()
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403, 'Acesso não autorizado.');
        }

        $grades = Grade::with(['enrollment.user', 'subject'])->get();
        return view('grades.index', compact('grades'));
    }

    // Formulário para criar nota (apenas professores)
    public function create()
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403, 'Acesso não autorizado.');
        }

        $students = User::where('role', 'student')->get();
        $subjects = Subject::all();
        return view('grades.create', compact('students', 'subjects'));
    }

    // Guardar nota (apenas professores)
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403, 'Acesso não autorizado.');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'test1' => 'required|numeric',
            'test2' => 'required|numeric',
            'test3' => 'required|numeric',
            'exam' => 'required|numeric',
            'recurrence_exam' => 'nullable|numeric',
        ]);

        $subject = Subject::findOrFail($request->subject_id);

        // Inclui o ano atual para inscrição (ajuste conforme sua regra)
        $year = date('Y');

        // Garantir inscrição com ano
        $enrollment = Enrollment::firstOrCreate([
            'user_id' => $request->user_id,
            'course_id' => $subject->course_id,
            'year' => $year,
        ]);

        // Cálculo da média dos testes
        $tests_average = ($request->test1 + $request->test2 + $request->test3) / 3;

        // Usa recorrência se for maior que exame normal
        $exam_score = $request->recurrence_exam && $request->recurrence_exam > $request->exam
            ? $request->recurrence_exam
            : $request->exam;

        // Nota final: 40% testes + 60% exame ou recorrência
        $final_score = round(($tests_average * 0.4) + ($exam_score * 0.6), 2);

        // Situação
        $status = $final_score >= 10 ? 'Aprovado' : 'Reprovado';

        Grade::create([
            'enrollment_id' => $enrollment->id,
            'subject_id' => $request->subject_id,
            'test1' => $request->test1,
            'test2' => $request->test2,
            'test3' => $request->test3,
            'exam' => $request->exam,
            'recurrence_exam' => $request->recurrence_exam,
            'final_score' => $final_score,
            'status' => $status,
        ]);

        return redirect()->route('grades.index')->with('success', 'Nota adicionada!');
    }

    // Formulário para editar nota (apenas professores)
    public function edit(Grade $grade)
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403, 'Acesso não autorizado.');
        }

        $students = User::where('role', 'student')->get();
        $subjects = Subject::all();
        return view('grades.edit', compact('grade', 'students', 'subjects'));
    }

    // Atualizar nota (apenas professores)
    public function update(Request $request, Grade $grade)
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403, 'Acesso não autorizado.');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'test1' => 'required|numeric',
            'test2' => 'required|numeric',
            'test3' => 'required|numeric',
            'exam' => 'required|numeric',
            'recurrence_exam' => 'nullable|numeric',
        ]);

        $tests_average = ($request->test1 + $request->test2 + $request->test3) / 3;

        $exam_score = $request->recurrence_exam && $request->recurrence_exam > $request->exam
            ? $request->recurrence_exam
            : $request->exam;

        $final_score = round(($tests_average * 0.4) + ($exam_score * 0.6), 2);

        $status = $final_score >= 10 ? 'Aprovado' : 'Reprovado';

        $subject = Subject::findOrFail($request->subject_id);

        $year = date('Y');

        $enrollment = Enrollment::firstOrCreate([
            'user_id' => $request->user_id,
            'course_id' => $subject->course_id,
            'year' => $year,
        ]);

        $grade->update([
            'enrollment_id' => $enrollment->id,
            'subject_id' => $request->subject_id,
            'test1' => $request->test1,
            'test2' => $request->test2,
            'test3' => $request->test3,
            'exam' => $request->exam,
            'recurrence_exam' => $request->recurrence_exam,
            'final_score' => $final_score,
            'status' => $status,
        ]);

        return redirect()->route('grades.index')->with('success', 'Nota atualizada!');
    }

    // Apagar nota (apenas professores)
    public function destroy(Grade $grade)
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403, 'Acesso não autorizado.');
        }

        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Nota removida!');
    }

    // Estudante vê as suas próprias notas
    public function studentGrades()
    {
        $grades = Grade::whereHas('enrollment', function ($query) {
            $query->where('user_id', auth()->id());
        })->with('subject')->get();

        return view('grades.student', compact('grades'));
    }
}
