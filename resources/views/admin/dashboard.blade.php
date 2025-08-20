@extends('layouts.app')

@section('content')
<div class="flex justify-center mt-8">
    <div class="w-full max-w-6xl">

        {{-- Linha com cartões lado a lado --}}
        <div class="flex flex-wrap gap-6 mb-8 justify-between">

            <!-- Matrículas -->
            <div class="flex-1 min-w-[200px] bg-gradient-to-r from-blue-100 to-blue-200 shadow rounded-lg p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-blue-800">Matrículas</h3>
                    <div class="bg-blue-500 p-2 rounded-full">
                        <i class="fas fa-users text-white"></i>
                    </div>
                </div>
                <p class="text-3xl text-blue-700 font-bold mt-3">{{ $enrollments }}</p>
                <span class="text-sm text-blue-600">Activas no sistema</span>

                <!-- Botão PDF -->
                <div class="mt-4 text-right">
                    <a href="{{ route('admin.pdf.enrollments') }}" 
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-800 transition text-sm">
                       📄 Baixar PDF
                    </a>
                </div>
            </div>

            <!-- Estudantes -->
            <div class="flex-1 min-w-[200px] bg-gradient-to-r from-blue-100 to-blue-200 shadow rounded-lg p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-blue-800">Estudantes</h3>
                    <div class="bg-blue-500 p-2 rounded-full">
                        <i class="fas fa-users text-white"></i>
                    </div>
                </div>
                <p class="text-3xl text-blue-700 font-bold mt-3">{{ $activeStudents }}</p>
                <span class="text-sm text-blue-800">Activos</span>

                <!-- Botão PDF -->
                <div class="mt-4 text-right">
                    <a href="{{ route('admin.pdf.students') }}" 
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition text-sm">
                       📄 Baixar PDF
                    </a>
                </div>
            </div>

            <!-- Professores -->
            <div class="flex-1 min-w-[200px] bg-gradient-to-r from-blue-100 to-blue-200 shadow rounded-lg p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-blue-800">Professores</h3>
                    <div class="bg-blue-500 p-2 rounded-full">
                        <i class="fas fa-users text-white"></i>
                    </div>
                </div>
                <p class="text-3xl text-blue-700 font-bold mt-3">{{ $teachers }}</p>
                <span class="text-sm text-blue-600">Actuando na instituição</span>

                <!-- Botão PDF -->
                <div class="mt-4 text-right">
                    <a href="{{ route('admin.pdf.teachers') }}" 
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition text-sm">
                       📄 Baixar PDF
                    </a>
                </div>
            </div>

        </div>

        {{-- Disciplinas --}}
        <div class="bg-gradient-to-r from-blue-100 to-yellow-300 shadow rounded-lg p-6 mb-8 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-blue-800">Disciplinas</h3>
                <div class="flex gap-2">
                    <a href="{{ route('admin.subjects.create') }}" 
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                       + Adicionar Disciplina
                    </a>
                </div>
            </div>
            <p class="text-3xl text-blue-700 font-bold">{{ $subjects }}</p>
        </div>

        {{-- Notificações --}}
        <div class="bg-gradient-to-r from-blue-100 to-gray-200 shadow rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-blue-800">Notificações</h3>
                <div class="flex gap-2">
                    <a href="{{ route('admin.notifications.create') }}" 
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                       + Adicionar Notificação
                    </a>
                </div>
            </div>

            @if ($notifications->isNotEmpty())
                <ul class="list-disc pl-5 text-gray-700 space-y-1">
                    @foreach ($notifications as $notification)
                        <li>
                            <strong>{{ $notification->title }}:</strong>
                            {{ $notification->message }}
                            <span class="text-sm text-gray-500 block">{{ $notification->created_at->format('d/m/Y H:i') }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-red-500 font-bold">Nenhuma notificação disponível.</p>
            @endif
        </div>

    </div>
</div>
@endsection
