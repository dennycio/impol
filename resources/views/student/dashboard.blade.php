@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-6">
        <h2 class="text-2xl font-bold mb-4">Bem-vindo, {{ Auth::user()->name }}!</h2>

        <!-- Botão para ver notas -->
        <a href="{{ route('student.grades.index') }}" 
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
            Ver Notas
        </a>
    </div>
@endsection
