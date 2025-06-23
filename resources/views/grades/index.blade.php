@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Lista de Notas</h1>

    @if(session('success'))
        <div class="flex items-center bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.5-5.5 1.4-1.4L10 12.2l4.1-4.1 1.4 1.4z"/></svg>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <table class="w-full border-collapse border border-gray-300 text-sm">
        <thead>
            <tr class="bg-gray-100">
                @if(Auth::user()->role === 'teacher')
                    <th class="border border-gray-300 p-2">Estudante</th>
                @endif
                <th class="border border-gray-300 p-2">Disciplina</th>
                <th class="border border-gray-300 p-2">Teste 1</th>
                <th class="border border-gray-300 p-2">Teste 2</th>
                <th class="border border-gray-300 p-2">Teste 3</th>
                <th class="border border-gray-300 p-2">Exame</th>
                <th class="border border-gray-300 p-2">Recorrência</th>
                <th class="border border-gray-300 p-2">Média Testes</th>
                <th class="border border-gray-300 p-2">Nota Final</th>
                <th class="border border-gray-300 p-2">Situação</th>
                @if(Auth::user()->role === 'teacher')
                    <th class="border border-gray-300 p-2">Ações</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($grades as $grade)
                <tr>
                    @if(Auth::user()->role === 'teacher')
                        <td class="border border-gray-300 p-2">
                            {{ optional(optional($grade->enrollment)->user)->name ?? 'N/A' }}
                        </td>
                    @endif
                    <td class="border border-gray-300 p-2">
                        {{ optional($grade->subject)->name ?? 'N/A' }}
                    </td>
                    <td class="border border-gray-300 p-2 {{ $grade->test1 < 0 ? 'text-red-600 font-bold' : '' }}">
                        {{ $grade->test1 ?? '' }}
                    </td>
                    <td class="border border-gray-300 p-2 {{ $grade->test2 < 0 ? 'text-red-600 font-bold' : '' }}">
                        {{ $grade->test2 ?? '' }}
                    </td>
                    <td class="border border-gray-300 p-2 {{ $grade->test3 < 0 ? 'text-red-600 font-bold' : '' }}">
                        {{ $grade->test3 ?? '' }}
                    </td>
                    <td class="border border-gray-300 p-2 {{ $grade->exam < 0 ? 'text-red-600 font-bold' : '' }}">
                        {{ $grade->exam ?? '' }}
                    </td>
                    <td class="border border-gray-300 p-2 {{ $grade->recurrence_exam < 0 ? 'text-red-600 font-bold' : '' }}">
                        {{ $grade->recurrence_exam ?? '' }}
                    </td>
                    <td class="border border-gray-300 p-2">
                        @php
                            $average = $grade->test1 && $grade->test2 && $grade->test3 
                                ? round(($grade->test1 + $grade->test2 + $grade->test3) / 3, 2) 
                                : '';
                        @endphp
                        <span class="{{ $average < 0 ? 'text-red-600 font-bold' : '' }}">{{ $average }}</span>
                    </td>
                    <td class="border border-gray-300 p-2 {{ $grade->final_score < 0 ? 'text-red-600 font-bold' : '' }}">
                        {{ $grade->final_score ?? '' }}
                    </td>
                    <td class="border border-gray-300 p-2">
                        <span class="{{ $grade->status === 'Reprovado' ? 'text-red-600 font-bold' : 'text-green-600 font-bold' }}">
                            {{ $grade->status ?? '' }}
                        </span>
                    </td>
                    @if(Auth::user()->role === 'teacher')
                        <td class="border border-gray-300 p-2 space-x-2">
                            <a href="{{ route('grades.edit', $grade->id) }}" class="inline-block bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Editar</a>
                            <form action="{{ route('grades.destroy', $grade->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza que deseja apagar esta nota?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-block bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">Apagar</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ Auth::user()->role === 'teacher' ? 11 : 10 }}" class="text-center p-4">Nenhuma nota encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
