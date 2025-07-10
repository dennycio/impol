<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\User;
use App\Models\Subject;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'teacher') {
            $grades = Grade::with(['enrollment.user', 'subject'])->get();
        } elseif ($user->role === 'student') {
            $grades = Grade::whereHas('enrollment', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with('subject')->get();
        } else {
            abort(403, 'Acesso não autorizado.');
        }

        return view('grades.index', compact('grades'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403, 'Acesso não autorizado.');
        }

        $students = User::where('role', 'student')->get();
        $subjects = Subject::all();
        return view('grades.create', compact('students', 'subjects'));
    }

    public function store(Request $request)
    {
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

        $enrollment = Enrollment::firstOrCreate([
            'user_id' => $request->user_id,
            'course_id' => $subject->course_id,
        ]);

        $test_avg = ($request->test1 + $request->test2 + $request->test3) / 3;
        $exam = $request->exam;
        $recurrence = $request->recurrence_exam;

        if ($exam < 10) {
            if ($recurrence !== null && $recurrence >= 10) {
                $final_score = ($test_avg * 0.6) + ($recurrence * 0.4);
                $status = $final_score >= 10 ? 'Aprovado' : 'Reprovado';
            } else {
                $final_score = ($test_avg * 0.6) + ($exam * 0.4);
                $status = 'Reprovado';
            }
        } else {
            $final_score = ($test_avg * 0.6) + ($exam * 0.4);
            $status = $final_score >= 10 ? 'Aprovado' : 'Reprovado';
        }

        Grade::create([
            'enrollment_id' => $enrollment->id,
            'subject_id' => $request->subject_id,
            'test1' => $request->test1,
            'test2' => $request->test2,
            'test3' => $request->test3,
            'exam' => $exam,
            'recurrence_exam' => $recurrence,
            'final_score' => round($final_score, 2),
            'status' => $status,
        ]);

        return redirect()->route('grades.index')->with('success', 'Nota adicionada!');
    }

    public function edit(Grade $grade)
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403, 'Acesso não autorizado.');
        }

        $students = User::where('role', 'student')->get();
        $subjects = Subject::all();
        return view('grades.edit', compact('grade', 'students', 'subjects'));
    }

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

        $subject = Subject::findOrFail($request->subject_id);

        $enrollment = Enrollment::firstOrCreate([
            'user_id' => $request->user_id,
            'course_id' => $subject->course_id,
        ]);

        $test_avg = ($request->test1 + $request->test2 + $request->test3) / 3;
        $exam = $request->exam;
        $recurrence = $request->recurrence_exam;

        if ($exam < 10) {
            if ($recurrence !== null && $recurrence >= 10) {
                $final_score = ($test_avg * 0.6) + ($recurrence * 0.4);
                $status = $final_score >= 10 ? 'Aprovado' : 'Reprovado';
            } else {
                $final_score = ($test_avg * 0.6) + ($exam * 0.4);
                $status = 'Reprovado';
            }
        } else {
            $final_score = ($test_avg * 0.6) + ($exam * 0.4);
            $status = $final_score >= 10 ? 'Aprovado' : 'Reprovado';
        }

        $grade->update([
            'enrollment_id' => $enrollment->id,
            'subject_id' => $request->subject_id,
            'test1' => $request->test1,
            'test2' => $request->test2,
            'test3' => $request->test3,
            'exam' => $exam,
            'recurrence_exam' => $recurrence,
            'final_score' => round($final_score, 2),
            'status' => $status,
        ]);

        return redirect()->route('grades.index')->with('success', 'Nota actualizada!');
    }

    public function destroy(Grade $grade)
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403, 'Acesso não autorizado.');
        }

        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Nota removida!');
    }
}
