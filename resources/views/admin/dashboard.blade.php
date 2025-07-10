@extends('layouts.app')

@section('content')
<div class="flex justify-center mt-8">
    <div class="w-full max-w-6xl">

        {{-- Linha com cartões lado a lado --}}
        <div class="flex flex-wrap gap-6 mb-8 justify-between">

            <!-- Estudantes -->
            <div class="flex-1 min-w-[200px] bg-white shadow rounded p-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Estudantes</h3>
                <p class="text-3xl text-blue-600 font-bold">{{ $activeStudents }}</p>
            </div>

            <!-- Professores -->
            <div class="flex-1 min-w-[200px] bg-white shadow rounded p-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Professores</h3>
                <p class="text-3xl text-purple-600 font-bold">{{ $teachers }}</p>
            </div>

            <!-- Matrículas -->
            <div class="flex-1 min-w-[200px] bg-white shadow rounded p-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Matrículas</h3>
                <p class="text-3xl text-green-600 font-bold">{{ $enrollments }}</p>
            </div>

            <!-- Disciplinas -->
            <div class="flex-1 min-w-[200px] bg-white shadow rounded p-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Disciplinas</h3>
                <p class="text-3xl text-yellow-600 font-bold">{{ $subjects }}</p>
            </div>

        </div>

        {{-- Notificações --}}
        <div class="bg-white shadow rounded p-6">

            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Notificações</h3>

                <a href="{{ route('admin.notifications.create') }}" 
                   class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                   + Adicionar Notificação
                </a>
            </div>

            @if ($notifications->isNotEmpty())
                <ul class="list-disc pl-5 text-gray-600 space-y-1">
                    @foreach ($notifications as $notification)
                        <li>
                            <strong>{{ $notification->title }}:</strong>
                            {{ $notification->message }}
                            <span class="text-sm text-gray-400 block">{{ $notification->created_at->format('d/m/Y H:i') }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">Nenhuma notificação disponível.</p>
            @endif

        </div>
        {{-- Botão para adicionar disciplina --}}
        <div class="mb-6 text-right">
                <a href="{{ route('admin.subjects.create') }}" 
                    class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                    + Adicionar Disciplina
                </a>
        </div>

    </div>
</div>
@endsection
