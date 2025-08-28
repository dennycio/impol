<div class="fixed top-0 left-0 h-full w-64 bg-white shadow-md z-40">
    <div class="scroll-sidebar h-full overflow-y-auto px-4 pt-5">
        <ul class="space-y-2 text-sm text-gray-600">
            <li class="text-xs font-bold pb-2 text-gray-400">Início</li>

            <li>
                <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-blue-100 hover:text-blue-600 transition-all">
                    Página Inicial
                </a>
            </li>

            {{-- Link para visualizar perfil --}}
            <li>
                <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-blue-100 hover:text-blue-600 transition-all">
                    Perfil
                </a>
            </li>

            {{-- Links específicos conforme o tipo de utilizador --}}
            @if(Auth::user()->role === 'student')
                <li>
                    <a href="{{ route('student.grades.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-blue-100 hover:text-blue-600 transition-all">
                        Notas
                    </a>
                </li>
                <li>
                    <a href="{{ route('student.enrollments.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-green-100 hover:text-green-600 transition-all">
                        Matrícula
                    </a>
                </li>
            @elseif(Auth::user()->role === 'teacher')
                <li>
                    <a href="{{ route('grades.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-blue-100 hover:text-blue-600 transition-all">
                        Notas
                    </a>
                </li>
                <li>
                    <a href="{{ route('grades.create') }}" class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-blue-100 hover:text-blue-600 transition-all">
                        Adicionar Notas
                    </a>
                </li>
            @endif

            <li>
                <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-blue-100 hover:text-blue-600 transition-all">
                    Notificações
                </a>
            </li>
        </ul>
    </div>
</div>
