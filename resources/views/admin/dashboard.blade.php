@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Painel do Administrador</h1>

    <!-- Card para gerir utilizadores -->
    <div class="inline-block bg-white border border-blue-500 rounded-lg shadow-md p-6 mr-4">
        <a href="#"
           class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            <!-- Ícone de utilizador -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5.121 17.804A8 8 0 0112 15a8 8 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Gerir Utilizadores
        </a>
    </div>

    <!-- Card para gerir disciplinas -->
    <div class="inline-block bg-white border border-blue-500 rounded-lg shadow-md p-6 mr-4">
        <a href="{{ route('subjects.index') }}"
           class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            <!-- Ícone de livro/disciplina -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 20h9M12 4H3m9 16V4m0 0l3 3m-3-3l-3 3" />
            </svg>
            Gerir Disciplinas
        </a>
    </div>
</div>
@endsection
