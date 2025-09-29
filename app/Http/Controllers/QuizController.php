<?php

namespace App\Http\Controllers;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Character;
use App\Models\Characters_quiz;
use App\Models\Inscription;
use App\Models\Quizzes_History;
use App\Models\Course;
use Illuminate\Support\Facades\Log;

class QuizController extends Controller
{

    public function check(Request $request, string $token)
    {
        try {
            $userId = Auth::user()->id;
            
            // Buscar el curso por token
            $course = Course::where('token', $token)->first();
            if (!$course) {
                return redirect()->route('dashboard')->with('error', 'Curso no encontrado.');
            }

            // Buscar la inscripción del usuario en este curso específico
            $inscription = Inscription::where('id_user', $userId)
                ->where('id_course', $course->id)
                ->first();
                
            if (!$inscription) {
                return redirect()->route('dashboard')->with('error', 'No estás inscrito en este curso.');
            }

            // Buscar el character asociado a esta inscripción
            $character = Character::where('id_inscription', $inscription->id)->first();
            if (!$character) {
                return redirect()->route('dashboard')->with('error', 'No tienes un personaje creado para este curso.');
            }

            $correctAnswers = 0;
            $totalQuestions = count($request->input('answerselected', []));

            // Procesar respuestas
            foreach ($request->input('answerselected', []) as $quizId => $selectedAnswer) {
                $quiz = Quiz::find($quizId);
                
                if (!$quiz) {
                    continue; // Saltar si no se encuentra el quiz
                }

                $isCorrect = $quiz->correct_answer === $selectedAnswer;
                
                if ($isCorrect) {
                    $correctAnswers++;
                }

                // Crear registro del resultado
                Characters_quiz::create([
                    'id_character' => $character->id,
                    'id_quiz' => $quiz->id,
                    'result' => $isCorrect ? 'correct' : 'incorrect'
                ]);
            }

            // Calcular resultado (evitar división por cero)
            $result = $totalQuestions > 0 ? ($correctAnswers / $totalQuestions) * 100 : 0;

            // Buscar el último quiz del character para determinar el número siguiente
            $characterLastQuiz = Quizzes_History::where('id_character', $character->id)
                ->orderBy('created_at', 'desc')
                ->first();

            $nextQuizNumber = $characterLastQuiz ? ($characterLastQuiz->quiz + 1) : 1;

            // Crear registro en el historial
            Quizzes_History::create([
                'id_character' => $character->id,
                'score' => $result,
                'quiz' => $nextQuizNumber
            ]);

            return redirect('/main/' . $token . '/player/character')
                ->with('success', "Quiz completado! Obtuviste {$correctAnswers} de {$totalQuestions} respuestas correctas ({$result}%)");

        } catch (\Exception $e) {
            Log::error('Error en QuizController@check: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'token' => $token,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('dashboard')
                ->with('error', 'Ocurrió un error al procesar el quiz. Por favor, inténtalo nuevamente.');
        }
    }
}
