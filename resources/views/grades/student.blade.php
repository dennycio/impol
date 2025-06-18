@extends('layouts.app')

@section('content')
    <h1 class="text-2xl mb-4">Minhas Notas</h1>

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th>Disciplina</th>
                <th>Nota</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grades as $grade)
                <tr>
                    <td>{{ $grade->subject->name }}</td>
                    <td>{{ $grade->grade }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
