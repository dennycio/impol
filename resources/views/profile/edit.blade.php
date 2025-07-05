@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Editar Perfil</h2>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label class="block font-medium">Nome</label>
            <input type="text" name="name" class="w-full border p-2 rounded" value="{{ old('name', auth()->user()->name) }}">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded" value="{{ old('email', auth()->user()->email) }}">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Actualizar</button>
    </form>
</div>
@endsection
