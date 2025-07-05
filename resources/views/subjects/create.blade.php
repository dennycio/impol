@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Adicionar Disciplina</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subjects.store') }}" method="POST">
        @csrf

        <!-- Nome -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Nome da Disciplina</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Curso -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Curso</label>
            <select name="course_id" class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="">-- Selecione --</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Ano -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Ano</label>
            <select name="year" class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="">-- Selecione --</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ old('year') == $i ? 'selected' : '' }}>
                        {{ $i }}º Ano
                    </option>
                @endfor
            </select>
        </div>

        <!-- Botão -->
        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Guardar
        </button>
    </form>
</div>
@endsection
