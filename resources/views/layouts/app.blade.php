<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SGAImpol') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">

    <div class="min-h-screen flex flex-col">

        {{-- Sidebar --}}
        @include('partials.sidebar')

        <div class="flex flex-col flex-1 ml-64">

            {{-- Header --}}
            @include('partials.header')

            {{-- Conteúdo principal --}}
            <main class="flex-1 p-4">
                @yield('content') {{-- ou {{ $slot }} se for componente --}}
            </main>

            {{-- Footer fixo no fundo --}}
            @include('partials.footer')

        </div>
    </div>

</body>
</html>
