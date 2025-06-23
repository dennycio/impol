@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Editar Disciplina</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            <ul class="list-disc ml-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-medium">Nome da Disciplina</label>
            <input type="text" name="name" class="w-full border p-2 rounded" value="{{ old('name', $subject->name) }}" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Curso</label>
            <select name="course_id" class="w-full border p-2 rounded" required>
                <option value="">Selecione o curso</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ $subject->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Atualizar</button>
        <a href="{{ route('subjects.index') }}" class="ml-4 text-gray-600 hover:underline">Cancelar</a>
    </form>
</div>
@endsection
