@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-md">
    <h1 class="text-2xl font-bold mb-4">Detalhes da Matrícula</h1>

    <div class="mb-4">
        <label class="block font-semibold">Curso:</label>
        <p class="border p-2 rounded bg-gray-100">{{ $enrollment->course->name }}</p>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Ano:</label>
        <p class="border p-2 rounded bg-gray-100">{{ $enrollment->year }}º Ano</p>
    </div>

    <a href="{{ route('student.enrollments.index') }}" 
       class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
        Voltar
    </a>
</div>
@endsection
