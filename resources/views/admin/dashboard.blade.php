@extends('layouts.app')

@section('content')

    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
    Bem-vindo, <strong>{{ Auth::user()->name }}</strong>!
</div>

    
@endsection