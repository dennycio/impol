@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-6 max-w-xl">
    <h2 class="text-2xl font-bold mb-6">Editar Disciplina</h2>

    <form method="POST" action="{{ route('admin.subjects.update', $subject) }}" class="bg-white shadow rounded p-6 space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold mb-1" for="name">Nome da Disciplina</label>
            <input type="text" name="name" id="name" value="{{ old('name', $subject->name) }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                   required>
            @error('name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1" for="course_id">Curso</label>
            <select name="course_id" id="course_id"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                    required>
                <option value="">Selecione um curso</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ $subject->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
            @error('course_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1" for="year">Ano</label>
            <input type="number" name="year" id="year" value="{{ old('year', $subject->year) }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                   min="1" max="4" required>
            @error('year')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-right">
            <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                Atualizar
            </button>
        </div>
    </form>
</div>
@endsection
