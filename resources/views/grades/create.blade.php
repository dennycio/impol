@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Adicionar Nota</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
            <ul class="list-disc ml-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('grades.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-medium mb-1">Estudante</label>
            <select name="user_id" class="w-full border p-2 rounded" required>
                <option value="">Selecione o estudante</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ old('user_id') == $student->id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Disciplina</label>
            <select name="subject_id" class="w-full border p-2 rounded" required>
                <option value="">Selecione a disciplina</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>

        @foreach (['test1', 'test2', 'test3', 'exam'] as $test)
            <div class="mb-4">
                <label class="block font-medium mb-1">{{ ucfirst(str_replace('test', 'Teste ', $test)) }}</label>
                <input type="number" step="0.01" name="{{ $test }}" class="w-full border p-2 rounded" value="{{ old($test) }}" required>
            </div>
        @endforeach

        <div class="mb-4">
            <label class="block font-medium mb-1">Recorrência (opcional)</label>
            <input type="number" step="0.01" name="recurrence_exam" class="w-full border p-2 rounded" value="{{ old('recurrence_exam') }}">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar</button>
        <a href="{{ route('grades.index') }}" class="ml-4 text-gray-600 hover:underline">Cancelar</a>
    </form>
</div>
@endsection
