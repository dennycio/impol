@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-6">
    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">Lista de Disciplinas</h2>
        <a href="{{ route('admin.subjects.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Nova Disciplina
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-600 font-semibold">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow rounded">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2">Nome</th>
                    <th class="px-4 py-2">Curso</th>
                    <th class="px-4 py-2">Ano</th>
                    <th class="px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $subject)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $subject->name }}</td>
                        <td class="px-4 py-2">{{ $subject->course->name ?? '—' }}</td>
                        <td class="px-4 py-2">{{ $subject->year }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.subjects.edit', $subject) }}" class="text-blue-500 hover:underline mr-2">Editar</a>
                            <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" class="inline-block" onsubmit="return confirm('Eliminar esta disciplina?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
