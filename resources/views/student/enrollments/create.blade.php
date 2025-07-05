@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-md">
    

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Card -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6 text-center">Nova Matrícula</h1>
        <form action="{{ route('student.enrollments.store') }}" method="POST">
            @csrf

            <!-- Seleção de curso -->
            <div class="mb-4">
                <label for="course_id" class="block mb-1 font-semibold">Curso</label>
                <select name="course_id" id="course_id" class="w-full border p-2 rounded" required>
                    <option value="">Selecione um curso</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Seleção de ano -->
            <div class="mb-6">
                <label for="year" class="block mb-1 font-semibold">Ano</label>
                <select name="year" id="year" class="w-full border p-2 rounded" required>
                    <option value="">Selecione o ano</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('year') == $i ? 'selected' : '' }}>
                            {{ $i }}º Ano
                        </option>
                    @endfor
                </select>
            </div>

            <!-- Botões -->
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded shadow-md">
                    Fazer Matrícula
                </button>
                <a href="{{ route('student.enrollments.index') }}" class="text-gray-600 hover:underline">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
