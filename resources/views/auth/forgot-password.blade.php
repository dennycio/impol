<x-guest-layout>
    <form method="POST" action="{{ route('password.email') }}" class="border border-blue-500 rounded-lg p-6 shadow-md bg-white w-full max-w-md mx-auto mt-10">
        @csrf

        <!-- Logo dentro do formulário -->
        <div class="flex justify-center mb-4">
            <img src="{{ asset('images/impol.jpg') }}" alt="Logo" class="h-20 w-auto">
        </div>

        <!-- Descrição -->
        <div class="mb-4 text-sm text-gray-600 text-center">
            {{ __('Esqueceu-se da sua palavra-passe? Indique o seu email e enviaremos um link para redefini-la.') }}
        </div>

        <!-- Estado da Sessão -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Email -->
        <div class="mb-4">
            <x-input-label for="email" :value="'Email'" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Botão azul centralizado -->
        <div class="flex items-center justify-center">
            <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                {{ __('Enviar Link de Redefinição') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
