@extends('layouts.app')

@section('content')
    <h1 class="text-2xl mb-4">Notas</h1>

    <a href="{{ route('grades.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Adicionar Nota</a>

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th>Estudante</th>
                <th>Disciplina</th>
                <th>Nota</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grades as $grade)
                <tr>
                    <td>{{ $grade->student->name }}</td>
                    <td>{{ $grade->subject->name }}</td>
                    <td>{{ $grade->grade }}</td>
                    <td>
                        <a href="{{ route('grades.edit', $grade) }}" class="text-blue-500">Editar</a> |
                        <form action="{{ route('grades.destroy', $grade) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500">Apagar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
