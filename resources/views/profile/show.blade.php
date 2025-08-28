@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow mt-6">
    <h2 class="text-2xl font-bold mb-6">Meu Perfil</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div><strong>Nome:</strong> {{ $user->name }}</div>
        <div><strong>Email:</strong> {{ $user->email }}</div>
        <div><strong>Curso:</strong> {{ $user->course?->name ?? '-' }}</div>
        <div><strong>Telefone:</strong> {{ $user->phone ?? '-' }}</div>
        <div><strong>Endereço:</strong> {{ $user->address ?? '-' }}</div>
        <div><strong>Data de Nascimento:</strong> {{ $user->birthdate ?? '-' }}</div>
        <div><strong>Sexo:</strong> {{ $user->gender ?? '-' }}</div>
        <div><strong>Nível / Classe:</strong> {{ $user->level ?? '-' }}</div>
        <div><strong>Grupo Anterior:</strong> {{ $user->previous_group ?? '-' }}</div>
        <div><strong>Nome do Pai:</strong> {{ $user->father_name ?? '-' }}</div>
        <div><strong>Nome da Mãe:</strong> {{ $user->mother_name ?? '-' }}</div>
        <div><strong>Estado Civil:</strong> {{ $user->marital_status ?? '-' }}</div>
    </div>

    <div class="mt-6">
        <a href="{{ route('profile.edit') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Editar Perfil
        </a>
    </div>
</div>
@endsection
