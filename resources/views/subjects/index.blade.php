@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Lista de Disciplinas</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('subjects.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Adicionar Disciplina
    </a>

    <table class="w-full border-collapse border border-gray-300 text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Nome</th>
                <th class="border p-2">Curso</th>
                <th class="border p-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($subjects as $subject)
                <tr>
                    <td class="border p-2">{{ $subject->name }}</td>
                    <td class="border p-2">{{ $subject->course->name ?? 'N/A' }}</td>
                    <td class="border p-2">
                        <a href="{{ route('subjects.edit', $subject->id) }}" class="text-blue-600 hover:underline">Editar</a>
                        <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza que deseja remover?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2">Apagar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center p-4">Nenhuma disciplina encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
