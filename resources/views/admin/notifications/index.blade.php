@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Notificações</h2>
        <a href="{{ route('admin.notifications.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Nova Notificação
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded p-4">
        <table class="w-full text-sm border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">Título</th>
                    <th class="border p-2">Destino</th>
                    <th class="border p-2">Mensagem</th>
                    <th class="border p-2">Acções</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notifications as $notification)
                    <tr>
                        <td class="border p-2">{{ $notification->title }}</td>
                        <td class="border p-2 capitalize">{{ $notification->target }}</td>
                        <td class="border p-2">{{ Str::limit($notification->message, 50) }}</td>
                        <td class="border p-2 flex gap-2">
                            <a href="{{ route('admin.notifications.edit', $notification) }}" class="text-blue-600 hover:underline">Editar</a>
                            <form action="{{ route('admin.notifications.destroy', $notification) }}" method="POST" onsubmit="return confirm('Apagar esta notificação?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Apagar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
