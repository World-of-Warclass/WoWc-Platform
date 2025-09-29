<x-app-layout>
    <div class="flex justify-center items-center w-full min-h-screen bg-gray-900">
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg border border-gray-700 w-full max-w-6xl">
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-yellow-500 mb-2">Invitaciones del Curso</h1>
                <h2 class="text-xl text-gray-300">{{ $course->name }}</h2>
                <p class="text-gray-400 text-sm mt-2">Token del curso: {{ $course->token }}</p>
            </div>

            <!-- Botones de acción -->
            <div class="mb-6 flex gap-4 justify-center">
                <a href="{{ route('invitation.course', ['token' => $course->token]) }}" 
                   class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-2 px-4 rounded-lg transition-colors">
                    Nueva Invitación
                </a>
                <a href="{{ route('dashboard') }}" 
                   class="bg-gray-600 hover:bg-gray-500 text-gray-100 font-medium py-2 px-4 rounded-lg transition-colors">
                    Volver al Dashboard
                </a>
            </div>

            <!-- Mostrar mensajes de éxito o error -->
            @if (session('success'))
                <div class="bg-green-900 border border-green-700 text-green-200 px-4 py-3 rounded-lg mb-6">
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-900 border border-red-700 text-red-200 px-4 py-3 rounded-lg mb-6">
                    <p class="text-sm">{{ session('error') }}</p>
                </div>
            @endif

            <!-- Tabla de invitaciones -->
            @if($invitations->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full bg-gray-700 rounded-lg overflow-hidden">
                        <thead class="bg-gray-600">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Estudiante
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Código de Invitación
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Estado
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Fecha de Creación
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-600">
                            @foreach($invitations as $invitation)
                                <tr class="hover:bg-gray-600 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-100">{{ $invitation->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-300">
                                            {{ $invitation->email ?? 'No especificado' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-100 font-mono bg-gray-800 px-2 py-1 rounded cursor-pointer"
                                             onclick="copyToClipboard('{{ $invitation->code }}')"
                                             title="Haz clic para copiar">
                                            {{ $invitation->code }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($invitation->used)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-900 text-green-200">
                                                Utilizada
                                            </span>
                                        @else
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-900 text-yellow-200">
                                                Pendiente
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                        {{ $invitation->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button onclick="copyToClipboard('{{ $invitation->code }}')"
                                                class="text-yellow-400 hover:text-yellow-300 mr-3">
                                            Copiar Código
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="mt-6">
                    {{ $invitations->links() }}
                </div>
            @else
                <div class="text-center py-8">
                    <div class="text-gray-400 text-lg mb-4">No hay invitaciones creadas para este curso.</div>
                    <a href="{{ route('invitation.course', ['token' => $course->token]) }}" 
                       class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-2 px-4 rounded-lg transition-colors">
                        Crear Primera Invitación
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Script para copiar al portapapeles -->
    <script>
        function copyToClipboard(text) {
            if (navigator.clipboard && window.isSecureContext) {
                // Método moderno
                navigator.clipboard.writeText(text).then(function() {
                    showNotification('Código copiado al portapapeles!');
                }, function(err) {
                    console.error('Error al copiar: ', err);
                    fallbackCopyTextToClipboard(text);
                });
            } else {
                // Fallback para navegadores más antiguos
                fallbackCopyTextToClipboard(text);
            }
        }

        function fallbackCopyTextToClipboard(text) {
            var textArea = document.createElement("textarea");
            textArea.value = text;
            textArea.style.top = "0";
            textArea.style.left = "0";
            textArea.style.position = "fixed";
            
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            
            try {
                var successful = document.execCommand('copy');
                if (successful) {
                    showNotification('Código copiado al portapapeles!');
                } else {
                    showNotification('Error al copiar el código');
                }
            } catch (err) {
                console.error('Error al copiar: ', err);
                showNotification('Error al copiar el código');
            }
            
            document.body.removeChild(textArea);
        }

        function showNotification(message) {
            // Crear elemento de notificación
            const notification = document.createElement('div');
            notification.textContent = message;
            notification.className = 'fixed top-4 right-4 bg-green-600 text-white px-4 py-2 rounded-lg shadow-lg z-50 transition-opacity duration-300';
            
            document.body.appendChild(notification);
            
            // Remover después de 3 segundos
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
    </script>
</x-app-layout>