@extends('layouts.app')

@section('content')

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">
        Olá, {{ Auth::user()->name }}
    </h1>

    <!-- Outras funcionalidades podem ir aqui -->
</div>
@endsection
