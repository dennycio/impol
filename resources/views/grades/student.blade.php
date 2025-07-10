@extends('layouts.app')

@section('content')
    <div class="flex justify-center bg-gray-100 py-12">
        <div class="w-full max-w-5xl bg-white border border-gray-300 rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-6 text-blue-800">Minhas Notas</h2>

            @if($grades->isEmpty())
                <p class="text-gray-600">Nenhuma nota encontrada.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300 text-sm">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 p-2">Disciplina</th>
                                <th class="border border-gray-300 p-2">Teste 1</th>
                                <th class="border border-gray-300 p-2">Teste 2</th>
                                <th class="border border-gray-300 p-2">Teste 3</th>
                                <th class="border border-gray-300 p-2">Exame</th>
                                <th class="border border-gray-300 p-2">Recorrência</th>
                                <th class="border border-gray-300 p-2">Nota Final</th>
                                <th class="border border-gray-300 p-2">Situação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grades as $grade)
                                <tr>
                                    <td class="border border-gray-300 p-2">{{ $grade->subject->name ?? '-' }}</td>
                                    <td class="border border-gray-300 p-2">{{ $grade->test1 }}</td>
                                    <td class="border border-gray-300 p-2">{{ $grade->test2 }}</td>
                                    <td class="border border-gray-300 p-2">{{ $grade->test3 }}</td>
                                    <td class="border border-gray-300 p-2">{{ $grade->exam }}</td>
                                    <td class="border border-gray-300 p-2">{{ $grade->recurrence_exam ?? '-' }}</td>
                                    <td class="border border-gray-300 p-2">{{ $grade->final_score }}</td>
                                    <td class="border border-gray-300 p-2">
                                        <span class="{{ $grade->status === 'Reprovado' ? 'text-red-600 font-bold' : 'text-green-600 font-bold' }}">
                                            {{ $grade->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
