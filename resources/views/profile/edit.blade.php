@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    {{-- Caixa do formulário --}}
    <div class="w-full sm:w-[500px] bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-700">Editar Perfil</h2>

        {{-- Mensagem de sucesso --}}
        @if (session('status') === 'profile-updated')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-6">
                Perfil actualizado com sucesso!
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            {{-- Nome (só leitura) --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Nome</label>
                <input type="text" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                       value="{{ auth()->user()->name }}" readonly>
            </div>

            {{-- Email (só leitura) --}}
            <div class="mb-6">
                <label class="block font-medium mb-1">Email</label>
                <input type="email" class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed"
                       value="{{ auth()->user()->email }}" readonly>
            </div>

            {{-- Telefone --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Telefone</label>
                <input type="text" name="phone" class="w-full border p-2 rounded"
                       value="{{ old('phone', auth()->user()->phone) }}">
            </div>

            {{-- Endereço --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Endereço</label>
                <input type="text" name="address" class="w-full border p-2 rounded"
                       value="{{ old('address', auth()->user()->address) }}">
            </div>

            {{-- Data de nascimento --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Data de nascimento</label>
                <input type="date" name="birthdate" class="w-full border p-2 rounded"
                       value="{{ old('birthdate', auth()->user()->birthdate) }}">
            </div>

            {{-- Sexo --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Sexo</label>
                <select name="gender" class="w-full border p-2 rounded">
                    <option value="">Selecione</option>
                    <option value="Masculino" {{ auth()->user()->gender === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="Feminino" {{ auth()->user()->gender === 'Feminino' ? 'selected' : '' }}>Feminino</option>
                </select>
            </div>

            {{-- Nível / Classe --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Nível / Classe</label>
                <input type="text" name="level" class="w-full border p-2 rounded"
                       value="{{ old('level', auth()->user()->level) }}">
            </div>

            {{-- Grupo anterior --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Grupo Anterior</label>
                <input type="text" name="previous_group" class="w-full border p-2 rounded"
                       value="{{ old('previous_group', auth()->user()->previous_group) }}">
            </div>

            {{-- Filiação --}}
            <div class="grid grid-cols-1 gap-4 mb-4">
                <div>
                    <label class="block font-medium mb-1">Nome do Pai</label>
                    <input type="text" name="father_name" class="w-full border p-2 rounded"
                           value="{{ old('father_name', auth()->user()->father_name) }}">
                </div>
                <div>
                    <label class="block font-medium mb-1">Nome da Mãe</label>
                    <input type="text" name="mother_name" class="w-full border p-2 rounded"
                           value="{{ old('mother_name', auth()->user()->mother_name) }}">
                </div>
            </div>

            {{-- Estado civil --}}
            <div class="mb-6">
                <label class="block font-medium mb-1">Estado Civil</label>
                <select name="marital_status" class="w-full border p-2 rounded">
                    <option value="">Selecione</option>
                    <option value="Solteiro" {{ auth()->user()->marital_status === 'Solteiro' ? 'selected' : '' }}>Solteiro</option>
                    <option value="Casado" {{ auth()->user()->marital_status === 'Casado' ? 'selected' : '' }}>Casado</option>
                    <option value="Divorciado" {{ auth()->user()->marital_status === 'Divorciado' ? 'selected' : '' }}>Divorciado</option>
                    <option value="Viúvo" {{ auth()->user()->marital_status === 'Viúvo' ? 'selected' : '' }}>Viúvo</option>
                </select>
            </div>

            {{-- Botão --}}
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full transition">
                Actualizar
            </button>
        </form>
    </div>
</div>
@endsection
