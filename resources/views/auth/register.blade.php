<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" 
          class="border border-blue-500 rounded-lg p-6 shadow-md bg-white max-w-md mx-auto">
        @csrf

        <!-- Logo dentro do formulário -->
        <div class="flex justify-center mb-4">
            <img src="{{ asset('images/impol.jpg') }}" alt="Logo" class="h-20 w-auto">
        </div>

        <!-- Nome -->
        <div>
            <x-input-label for="name" :value="'Nome'" />
            <x-text-input id="name" class="block mt-1 w-full" 
                          type="text" name="name" :value="old('name')" 
                          required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="'Email'" />
            <x-text-input id="email" class="block mt-1 w-full" 
                          type="email" name="email" :value="old('email')" 
                          required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Papel -->
        <div class="mt-4">
            <x-input-label for="role" :value="'Função'" />
            <select id="role" name="role" 
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 
                           focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Estudante</option>
                <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Professor</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Curso (visível só se role = student) -->
        <div id="course-field" class="mt-4 hidden">
            <x-input-label for="course_id" :value="'Curso'" />
            <select id="course_id" name="course_id"
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 
                           focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                <option value="">-- Selecione um curso --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('course_id')" class="mt-2" />
        </div>

        <!-- Senha -->
        <div class="mt-4">
            <x-input-label for="password" :value="'Senha'" />
            <x-text-input id="password" class="block mt-1 w-full" 
                          type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar Senha -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="'Confirmar Senha'" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" 
                          type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Link + Botão centralizado -->
        <div class="flex flex-col items-center justify-center mt-6 space-y-3">
            <button type="submit" 
                    class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-200">
                Registar
            </button>
        </div>
    </form>

    <!-- Script para mostrar/ocultar campo curso -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roleSelect = document.getElementById('role');
            const courseField = document.getElementById('course-field');

            function toggleCourseField() {
                if (roleSelect.value === 'student') {
                    courseField.classList.remove('hidden');
                } else {
                    courseField.classList.add('hidden');
                }
            }

            roleSelect.addEventListener('change', toggleCourseField);

            // Executar na carga da página (caso role já venha selecionado no old())
            toggleCourseField();
        });
    </script>
</x-guest-layout>
