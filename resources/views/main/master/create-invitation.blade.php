<x-app-layout>
    <div class="flex justify-center items-center w-full min-h-screen bg-gray-900">
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg border border-gray-700 w-full max-w-md">
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-yellow-500 mb-2">Crear Invitación</h1>
                <h2 class="text-xl text-gray-300">Las leyendas de {{ $course->name }}</h2>
            </div>

            <form method="post" action="{{ route('invitations.generate', ['token' => $course->token]) }}" class="space-y-6">
                @csrf
                
                <!-- Mostrar errores de validación -->
                @if ($errors->any())
                    <div class="bg-red-900 border border-red-700 text-red-200 px-4 py-3 rounded-lg">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Mostrar mensaje de éxito -->
                @if (session('success'))
                    <div class="bg-green-900 border border-green-700 text-green-200 px-4 py-3 rounded-lg">
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Campo Nombre -->
                <div class="flex flex-col space-y-2">
                    <label for="name" class="text-gray-300 font-medium">Nombre del Estudiante:</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        class="bg-gray-700 border border-gray-600 text-gray-100 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                        placeholder="Ingresa el nombre del estudiante"
                        required>
                </div>

                <!-- Campo Email (si es necesario) -->
                <div class="flex flex-col space-y-2">
                    <label for="email" class="text-gray-300 font-medium">Email (Opcional):</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        class="bg-gray-700 border border-gray-600 text-gray-100 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                        placeholder="email@ejemplo.com">
                </div>

                <!-- Campo oculto -->
                <input type="hidden" name="id_course" value="{{ $course->id }}">

                <!-- Botón de submit -->
                <div class="flex flex-col space-y-4">
                    <button 
                        type="submit" 
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-3 px-4 rounded-lg transition-colors duration-200 transform hover:scale-105">
                        Crear Invitación
                    </button>
                    
                    <a href="{{ route('dashboard') }}" 
                       class="w-full bg-gray-600 hover:bg-gray-500 text-gray-100 font-medium py-3 px-4 rounded-lg transition-colors duration-200 text-center block">
                        Volver al Dashboard
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
