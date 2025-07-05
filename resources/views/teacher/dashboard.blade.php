@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Painel do Professor</h1>
    <!-- Card compacto com botão e ícone -->
    <div class="inline-block bg-white border border-blue-500 rounded-lg shadow-md p-6">
        <a href="{{ route('grades.create') }}"
           class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            <!-- Ícone de escrever (pencil) -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.232 5.232l3.536 3.536M9 11l6 6M4 20h4l10-10-4-4L4 16v4z" />
            </svg>
            Adicionar Nota
        </a>
    </div>
    <!-- Outras funcionalidades podem ir aqui -->
</div>
@endsection
