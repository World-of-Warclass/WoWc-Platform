<x-app-layout>
    <div class="flex justify-center items-center w-full min-h-screen bg-gray-900 py-8">
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg border border-gray-700 w-full max-w-4xl">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-yellow-500 mb-4">
                    📚 ¿Cómo unirse a una clase?
                </h1>
                <p class="text-xl text-gray-300">Guía paso a paso para estudiantes</p>
            </div>

            <!-- Paso 1 -->
            <div class="bg-gray-700 rounded-lg p-6 mb-6 border-l-4 border-yellow-500">
                <h2 class="text-2xl font-bold text-yellow-400 mb-4 flex items-center">
                    <span class="bg-yellow-500 text-gray-900 rounded-full w-8 h-8 flex items-center justify-center mr-3 text-lg font-bold">1</span>
                    Obtén el código de invitación
                </h2>
                <div class="text-gray-100 space-y-3">
                    <p>🎓 <strong>Tu profesor te proporcionará un código único</strong> para unirte a su curso.</p>
                    <p>📧 Este código puede llegarte por:</p>
                    <ul class="list-disc list-inside ml-4 space-y-1 text-gray-300">
                        <li>Email</li>
                        <li>WhatsApp o mensaje directo</li>
                        <li>En clase (escrito en la pizarra)</li>
                        <li>Plataforma educativa de tu institución</li>
                    </ul>
                    <div class="bg-gray-600 p-3 rounded mt-4">
                        <p class="text-sm text-gray-300">
                            💡 <strong>Ejemplo de código:</strong> 
                            <code class="bg-gray-800 text-yellow-400 px-2 py-1 rounded font-mono">SmVhbiBQw6lyZXomMjM=</code>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Paso 2 -->
            <div class="bg-gray-700 rounded-lg p-6 mb-6 border-l-4 border-blue-500">
                <h2 class="text-2xl font-bold text-blue-400 mb-4 flex items-center">
                    <span class="bg-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 text-lg font-bold">2</span>
                    Ve a tu Dashboard
                </h2>
                <div class="text-gray-100 space-y-3">
                    <p>🏠 <strong>Inicia sesión</strong> en la plataforma y ve a tu página principal (Dashboard).</p>
                    <p>🔍 <strong>Busca el botón amarillo</strong> en la esquina superior derecha que dice:</p>
                    <div class="flex justify-center my-4">
                        <button class="flex bg-yellow-500 py-2 px-4 gap-3 border-[3px] rounded-3xl items-center text-xl text-white shadow-lg cursor-not-allowed">
                            <span>➕</span>
                            <p class="font-bold">Unirse a una clase</p>
                            <span class="text-sm bg-white text-yellow-600 px-2 py-1 rounded-full ml-2">Código aquí</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Paso 3 -->
            <div class="bg-gray-700 rounded-lg p-6 mb-6 border-l-4 border-green-500">
                <h2 class="text-2xl font-bold text-green-400 mb-4 flex items-center">
                    <span class="bg-green-500 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 text-lg font-bold">3</span>
                    Introduce el código
                </h2>
                <div class="text-gray-100 space-y-3">
                    <p>👆 <strong>Haz clic en el botón</strong> "Unirse a una clase"</p>
                    <p>📝 Se abrirá una ventana donde debes:</p>
                    <ul class="list-disc list-inside ml-4 space-y-1 text-gray-300">
                        <li>Pegar o escribir el código de invitación</li>
                        <li>Verificar que esté correcto (sin espacios extra)</li>
                        <li>Hacer clic en "Unirse al Curso"</li>
                    </ul>
                    
                    <div class="bg-gray-600 p-4 rounded-lg mt-4">
                        <h4 class="text-yellow-400 font-semibold mb-2">📋 Consejos importantes:</h4>
                        <ul class="text-sm text-gray-300 space-y-1">
                            <li>• Copia y pega el código completo (evita escribirlo manualmente)</li>
                            <li>• No agregues espacios al inicio o final</li>
                            <li>• El código distingue entre mayúsculas y minúsculas</li>
                            <li>• Cada código solo se puede usar una vez</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Paso 4 -->
            <div class="bg-gray-700 rounded-lg p-6 mb-6 border-l-4 border-purple-500">
                <h2 class="text-2xl font-bold text-purple-400 mb-4 flex items-center">
                    <span class="bg-purple-500 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3 text-lg font-bold">4</span>
                    ¡Listo! Ya estás inscrito
                </h2>
                <div class="text-gray-100 space-y-3">
                    <p>✅ <strong>Si todo está correcto</strong>, verás un mensaje de éxito.</p>
                    <p>📚 <strong>El curso aparecerá</strong> en tu lista de "Mis Cursos" en el dashboard.</p>
                    <p>🎮 <strong>Podrás acceder</strong> a todas las actividades y contenido del curso.</p>
                </div>
            </div>

            <!-- Problemas comunes -->
            <div class="bg-red-900 bg-opacity-50 rounded-lg p-6 mb-6 border border-red-600">
                <h2 class="text-2xl font-bold text-red-400 mb-4 flex items-center">
                    ⚠️ ¿Tienes problemas?
                </h2>
                <div class="text-gray-100 space-y-3">
                    <div class="space-y-2">
                        <p class="font-semibold text-red-300">❌ "El código de invitación no es válido"</p>
                        <ul class="list-disc list-inside ml-4 text-sm text-gray-300">
                            <li>Verifica que hayas copiado el código completo</li>
                            <li>Asegúrate de no tener espacios extra</li>
                            <li>Contacta a tu profesor para verificar el código</li>
                        </ul>
                    </div>
                    
                    <div class="space-y-2">
                        <p class="font-semibold text-red-300">❌ "El código ya fue utilizado"</p>
                        <ul class="list-disc list-inside ml-4 text-sm text-gray-300">
                            <li>Cada código solo se puede usar una vez</li>
                            <li>Solicita un nuevo código a tu profesor</li>
                        </ul>
                    </div>
                    
                    <div class="space-y-2">
                        <p class="font-semibold text-red-300">❌ "Ya estás inscrito en este curso"</p>
                        <ul class="list-disc list-inside ml-4 text-sm text-gray-300">
                            <li>Revisa tu lista de "Mis Cursos" en el dashboard</li>
                            <li>El curso ya está disponible para ti</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex gap-4 justify-center">
                <a href="{{ route('dashboard') }}" 
                   class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-3 px-6 rounded-lg transition-colors">
                    Ir al Dashboard
                </a>
                <button onclick="window.history.back()" 
                        class="bg-gray-600 hover:bg-gray-500 text-gray-100 font-medium py-3 px-6 rounded-lg transition-colors">
                    Volver
                </button>
            </div>
        </div>
    </div>
</x-app-layout>