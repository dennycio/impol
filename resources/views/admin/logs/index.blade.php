@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Logs de Admin</h1>

    {{-- Filtro por período --}}
    <form method="GET" class="mb-4 flex gap-2">
        <input type="date" name="from" class="border p-2 rounded" value="{{ request('from') }}">
        <input type="date" name="to" class="border p-2 rounded" value="{{ request('to') }}">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filtrar</button>
    </form>

    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Data</th>
                <th class="border p-2">Admin</th>
                <th class="border p-2">Ação</th>
                <th class="border p-2">Descrição</th>
                <th class="border p-2">IP</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
                <tr>
                    <td class="border p-2">{{ $log->created_at }}</td>
                    <td class="border p-2">{{ $log->admin->name }}</td>
                    <td class="border p-2">{{ $log->action }}</td>
                    <td class="border p-2">{{ $log->description ?? '-' }}</td>
                    <td class="border p-2">{{ $log->ip_address ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border p-2 text-center">Nenhum log encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $logs->links() }}
    </div>
</div>
@endsection
