@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Minhas Matrículas</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse border border-gray-300 text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 p-2">Curso</th>
                <th class="border border-gray-300 p-2">Ano</th>
                <th class="border border-gray-300 p-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($enrollments as $enrollment)
                <tr>
                    <td class="border border-gray-300 p-2">
                        {{ $enrollment->course->name }}
                    </td>
                    <td class="border border-gray-300 p-2">
                        {{ $enrollment->year }}º Ano
                    </td>
                    <td class="border border-gray-300 p-2 space-x-2">
                        <a href="{{ route('student.enrollments.show', $enrollment->id) }}" 
                           class="inline-block bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                            Ver Detalhes
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center p-4">Nenhuma matrícula encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
