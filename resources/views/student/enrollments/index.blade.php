@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Minhas Matrículas</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('student.enrollments.create') }}" 
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mb-4 inline-block">
        Nova Matrícula
    </a>

    @if($enrollments->isEmpty())
        <p>Não tens matrículas registradas.</p>
    @else
        <table class="w-full border border-gray-300 rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">Curso</th>
                    <th class="border p-2">Data da Matrícula</th>
                    <th class="border p-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enrollments as $enrollment)
                <tr>
                    <td class="border p-2">{{ $enrollment->course->name }}</td>
                    <td class="border p-2">{{ $enrollment->created_at->format('d/m/Y') }}</td>
                    <td class="border p-2">
                        <a href="{{ route('student.enrollments.show', $enrollment->id) }}" class="text-blue-600 hover:underline mr-2">Ver</a>
                        <a href="{{ route('student.enrollments.edit', $enrollment->id) }}" class="text-yellow-600 hover:underline mr-2">Editar</a>
                        <form action="{{ route('student.enrollments.destroy', $enrollment->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza que deseja cancelar esta matrícula?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Cancelar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
