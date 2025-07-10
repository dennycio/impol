@extends('layouts.app')

@section('content')
<div class="flex justify-center mt-10">
    <div class="w-full max-w-2xl bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4 text-center">Editar Perfil</h2>

        @if (session('status') === 'profile-updated')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                Perfil actualizado com sucesso!
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            {{-- Nome (só leitura) --}}
            <div class="mb-4">
                <label class="block font-medium">Nome</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" value="{{ auth()->user()->name }}" readonly>
            </div>

            {{-- Email (só leitura) --}}
            <div class="mb-4">
                <label class="block font-medium">Email</label>
                <input type="email" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" value="{{ auth()->user()->email }}" readonly>
            </div>

            {{-- Telefone (editável) --}}
            <div class="mb-4">
                <label class="block font-medium">Telefone</label>
                <input type="text" name="phone" class="w-full border p-2 rounded" value="{{ old('phone', auth()->user()->phone) }}">
            </div>

            {{-- Endereço (editável) --}}
            <div class="mb-4">
                <label class="block font-medium">Endereço</label>
                <input type="text" name="address" class="w-full border p-2 rounded" value="{{ old('address', auth()->user()->address) }}">
            </div>

            {{-- Data de nascimento (só leitura) --}}
            <div class="mb-4">
                <label class="block font-medium">Data de nascimento</label>
                <input type="date" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" value="{{ auth()->user()->birthdate }}" readonly>
            </div>

            {{-- Sexo (só leitura) --}}
            <div class="mb-4">
                <label class="block font-medium">Sexo</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" value="{{ auth()->user()->gender }}" readonly>
            </div>

            {{-- Nível / Classe (só leitura) --}}
            <div class="mb-4">
                <label class="block font-medium">Nível / Classe</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" value="{{ auth()->user()->level }}" readonly>
            </div>

            {{-- Grupo anterior (só leitura) --}}
            <div class="mb-4">
                <label class="block font-medium">Grupo Anterior</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" value="{{ auth()->user()->previous_group }}" readonly>
            </div>

            {{-- Filiação (só leitura) --}}
            <div class="mb-4">
                <label class="block font-medium">Nome do Pai</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" value="{{ auth()->user()->father_name }}" readonly>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Nome da Mãe</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" value="{{ auth()->user()->mother_name }}" readonly>
            </div>

            {{-- Estado civil (editável) --}}
            <div class="mb-6">
                <label class="block font-medium">Estado Civil</label>
                <select name="marital_status" class="w-full border p-2 rounded">
                    <option value="">Selecione</option>
                    <option value="Solteiro" {{ auth()->user()->marital_status === 'Solteiro' ? 'selected' : '' }}>Solteiro</option>
                    <option value="Casado" {{ auth()->user()->marital_status === 'Casado' ? 'selected' : '' }}>Casado</option>
                    <option value="Divorciado" {{ auth()->user()->marital_status === 'Divorciado' ? 'selected' : '' }}>Divorciado</option>
                    <option value="Viúvo" {{ auth()->user()->marital_status === 'Viúvo' ? 'selected' : '' }}>Viúvo</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
                Actualizar
            </button>
        </form>
    </div>
</div>
@endsection
