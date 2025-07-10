@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow p-6 mt-6 rounded">
    <h2 class="text-xl font-bold mb-4">Editar Notificação</h2>

    <form action="{{ route('admin.notifications.update', $notification) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium">Título</label>
            <input type="text" name="title" class="w-full border p-2 rounded" value="{{ $notification->title }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Mensagem</label>
            <textarea name="message" class="w-full border p-2 rounded" rows="4" required>{{ $notification->message }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Destino</label>
            <select name="target" class="w-full border p-2 rounded" required>
                <option value="all" {{ $notification->target === 'all' ? 'selected' : '' }}>Todos</option>
                <option value="student" {{ $notification->target === 'student' ? 'selected' : '' }}>Estudantes</option>
                <option value="teacher" {{ $notification->target === 'teacher' ? 'selected' : '' }}>Professores</option>
            </select>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Actualizar</button>
        <a href="{{ route('admin.notifications.index') }}" class="ml-4 text-gray-600 hover:underline">Cancelar</a>
    </form>
</div>
@endsection
