<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Inscription;
use App\Models\Teacher;
use App\Models\Teachers_Course;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        // Obtener cursos con relaciones
        $courses = Course::all();

        // Obtener información del teacher si existe
        $teachers = Teacher::where('id_user', $userId)->get();

        // Obtener cursos de la institución de manera más eficiente
        $institutionCourses = collect();
        if ($teachers->isNotEmpty()) {
            $teacherIds = $teachers->pluck('id');
            $institutionCourses = Teachers_Course::whereIn('id_teacher', $teacherIds)
                ->with('course')
                ->get();
        }

        // Obtener inscripciones del usuario
        $inscriptions = Inscription::where('id_user', $userId)
            ->with('course')
            ->get();

        // Obtener cursos donde el usuario es estudiante
        $studentCourses = collect();
        if ($inscriptions->isNotEmpty()) {
            $courseIds = $inscriptions->pluck('id_course');
            $studentCourses = Teachers_Course::whereIn('id_course', $courseIds)
                ->with(['course', 'teacher'])
                ->get();
        }

        return view('dashboard', [
            'teacher' => $teachers,
            'institution_courses' => $institutionCourses,
            'inscriptions' => $inscriptions,
            'teachers_courses' => $studentCourses
        ]);
    }
}
