@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-md">
    <h1 class="text-2xl font-bold mb-4">Nova Matrícula</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('student.enrollments.store') }}" method="POST">
        @csrf
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

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Matricular
        </button>
        <a href="{{ route('student.enrollments.index') }}" class="ml-4 text-gray-600 hover:underline">Cancelar</a>
    </form>
</div>
@endsection
