<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Lista de cursos para o formulário
        $courses = \App\Models\Course::all();
        return view('auth.register', compact('courses'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
            'role'      => ['required', 'in:student,teacher,admin'],
            'course_id' => ['nullable', 'exists:courses,id'], // obrigatório apenas se role = student
        ]);

        // Criar utilizador
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        // Apenas para estudantes, salva o course_id
        if ($user->role === 'student' && $request->course_id) {
            $user->course_id = $request->course_id;
            $user->save();
        }

        event(new Registered($user));

        return redirect()->route('login');
    }
}
