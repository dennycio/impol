@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-6">
        <h2 class="text-2xl font-bold mb-4">Bem-vindo, {{ Auth::user()->name }}!</h2>
        <p class="text-gray-600">Este é o seu painel de professor.</p>
    </div>
@endsection
