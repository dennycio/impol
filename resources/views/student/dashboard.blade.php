@extends('layouts.app')

@section('content')
<div class="pt-4 container mx-auto mt-6">
    <h2 class="text-2xl font-bold mb-4">Bem-vindo, {{ Auth::user()->name }}!</h2>

    {{-- Cartões com ações rápidas --}}
    <div class="flex flex-wrap gap-6 mb-8 justify-between">

        <!-- Ver Notas -->
        <div class="flex-1 min-w-[200px] bg-white shadow rounded p-6">
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Notas</h3>
            <a href="{{ route('student.grades.index') }}" 
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                Ver Notas
            </a>
        </div>

        <!-- Fazer Matrícula -->
        <div class="flex-1 min-w-[200px] bg-white shadow rounded p-6">
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Matrículas</h3>
            <a href="{{ route('student.enrollments.index') }}" 
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                Fazer Matrícula
            </a>
        </div>

    </div>
</div>
@endsection
