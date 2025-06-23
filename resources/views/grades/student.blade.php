@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Minhas Notas</h1>

    <table class="w-full border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">Disciplina</th>
                <th class="p-2 border">Nota</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($grades as $grade)
                <tr>
                    <td class="p-2 border">{{ $grade->subject->name }}</td>
                    <td class="p-2 border">{{ $grade->grade }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="p-2 text-center">Ainda não tens notas registadas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
