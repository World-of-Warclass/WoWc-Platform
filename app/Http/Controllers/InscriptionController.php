<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Inscription;
use App\Models\Invitation;

class InscriptionController extends Controller
{
    public function validation(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ], [
            'code.required' => 'El código de invitación es obligatorio.',
        ]);

        // Buscar la invitación por código
        $invitation = Invitation::where('code', $request->code)
            ->where('used', false)
            ->with('course')
            ->first();

        if (!$invitation) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['code' => 'El código de invitación no es válido o ya fue utilizado.']);
        }

        $userId = auth()->id();
        $courseId = $invitation->id_course;

        // Verificar si el usuario ya está inscrito en este curso
        $existingInscription = Inscription::where('id_user', $userId)
            ->where('id_course', $courseId)
            ->first();

        if ($existingInscription) {
            return redirect()->route('dashboard')
                ->with('error', 'Ya estás inscrito en este curso: ' . $invitation->course->name);
        }

        try {
            // Crear la inscripción
            Inscription::create([
                'id_user' => $userId,
                'id_course' => $courseId,
            ]);

            // Marcar la invitación como usada
            $invitation->update(['used' => true]);

            // Redirigir al dashboard con mensaje de éxito
            return redirect()->route('dashboard')
                ->with('success', 'Te has inscrito correctamente al curso: ' . $invitation->course->name);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Ocurrió un error al procesar la inscripción. Por favor, intenta nuevamente.']);
        }
    }
}