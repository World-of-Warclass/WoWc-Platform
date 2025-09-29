<x-app-layout>
    <div class="bg-gray-900 w-full flex justify-center text-gray-100 flex-col gap-4 items-center p-4 min-h-screen">
        <!-- Información del usuario (solo para debug, se puede remover) -->
        @if(config('app.debug'))
            <details class="bg-gray-800 p-2 rounded text-xs text-gray-400 w-4/5">
                <summary>Debug Info (solo en desarrollo)</summary>
                <pre class="mt-2 text-xs">{{ Auth::user() }}</pre>
            </details>
        @endif

        <div class="flex w-full max-w-4xl flex-col bg-gray-800 border border-gray-600 rounded-lg shadow-lg overflow-hidden">
            <!-- Header del Quiz -->
            <section class="w-full flex p-6 bg-gray-700">
                <div class="p-2 w-full flex flex-col">
                    <h1 class="text-4xl font-bold text-center text-yellow-500 mb-4">QUIZ</h1>
                    <hr class="border-gray-500">
                </div>
            </section>

            <!-- Contenido del Quiz -->
            <section class="w-full flex p-6 flex-col gap-4 items-center">
                <div class="w-full space-y-4">
                    <form method="POST" action="{{ route('check.quiz', ['token' => $token]) }}"
                        class="flex flex-col gap-y-6">
                        @csrf
                        
                        <!-- Scrollable container para las preguntas -->
                        <div class="overflow-auto max-h-[60vh] space-y-6 pr-2">
                            @php $i = 1; @endphp
                            @foreach ($quizzes as $quiz)
                                <div class="bg-gray-700 rounded-lg overflow-hidden border border-gray-600 shadow-md">
                                    <!-- Header de la pregunta -->
                                    <div class="bg-red-600 flex flex-row justify-between items-center p-4">
                                        <h3 class="text-xl font-semibold text-white">
                                            Pregunta {{ $i++ }}
                                        </h3>
                                        <span class="bg-red-700 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                            2 pts
                                        </span>
                                    </div>

                                    <!-- Contenido de la pregunta -->
                                    <div class="bg-gray-700 p-4">
                                        <h2 class="text-lg font-semibold text-gray-100 mb-4 leading-relaxed">
                                            {{ $quiz->question }}
                                        </h2>
                                        
                                        <!-- Opciones de respuesta -->
                                        <div class="space-y-3">
                                            @foreach ($quiz->answers as $index => $answer)
                                                <div class="flex items-center p-3 bg-gray-600 rounded-lg hover:bg-gray-500 transition-colors">
                                                    <input type="radio" 
                                                           required
                                                           name="answerselected[{{ $quiz->id }}]"
                                                           value="{{ $answer }}"
                                                           id="answer_{{ $quiz->id }}_{{ $index }}"
                                                           class="mr-3 h-4 w-4 text-yellow-500 border-gray-400 focus:ring-yellow-500 bg-gray-600">
                                                    
                                                    <label for="answer_{{ $quiz->id }}_{{ $index }}" 
                                                           class="text-gray-100 cursor-pointer flex-grow">
                                                        {{ $answer }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Token y botón de envío -->
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="flex justify-center mt-6">
                            <button class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-3 px-8 rounded-lg transition-colors duration-200 transform hover:scale-105 shadow-lg" 
                                    type="submit">
                                <span class="text-lg">Entregar Quiz</span>
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>

        <!-- Botón de regreso (opcional) -->
        <div class="mt-4">
            <button onclick="window.history.back()" 
                    class="bg-gray-600 hover:bg-gray-500 text-gray-100 font-medium py-2 px-4 rounded-lg transition-colors">
                ← Volver
            </button>
        </div>
    </div>
</x-app-layout>
