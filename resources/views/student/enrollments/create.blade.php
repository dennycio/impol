@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-lg">

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6 text-center text-blue-700">Nova Matrícula</h1>

        <form action="{{ route('student.enrollments.store') }}" method="POST">
            @csrf

            <!-- Disciplinas como checkboxes -->
            <div class="mb-6">
                <label class="block mb-2 font-semibold text-gray-700">Escolha as disciplinas:</label>
                <div class="flex flex-wrap gap-3">
                    @foreach($courses as $course)
                        <label class="flex items-center space-x-2 border px-3 py-2 rounded shadow-sm hover:bg-gray-50 cursor-pointer">
                            <input type="checkbox" name="course_ids[]" value="{{ $course->id }}"
                                   {{ collect(old('course_ids'))->contains($course->id) ? 'checked' : '' }}>
                            <span class="text-gray-800">{{ $course->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Ano fixo -->
            <div class="mb-6">
                <label class="block mb-1 font-semibold text-gray-700">Ano</label>
                <div class="flex items-center gap-2">
                    <input type="text" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" value="1º Ano" readonly>
                    <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded"></span>
                </div>
                <input type="hidden" name="year" value="1">
            </div>

            <!-- Botões -->
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded shadow-md">
                    Confirmar Matrícula
                </button>
                <a href="{{ route('student.enrollments.index') }}" class="text-gray-600 hover:underline">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
