<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Invitation;


class MasterController extends Controller
{   
    public function createCourse(string $id)
    {
        $id_institution = Institution::find($id);
        $id_user= Auth()->user()->id;
        $teacher = Teacher::where('id_user', $id_user)->first();

        return view('main.create-courses', compact('teacher','id_institution'));
    }

    public function createGroup()
    {
        return view('main.master.create-group');
    }

    public function members()
    {
        $name = 'Members';
        return view('main.master.members', compact('name'));
    }

    public function groups()
    {
        $name = 'Groups';
        return view('main.master.groups', compact('name'));
    }

    public function tasks()
    {
        $name = 'Task';
        return view('main.master.tasks', compact('name'));
    }

    public function quizzes()
    {
        $name = 'Quizzes';
        return view('main.master.quizzes', compact('name'));
    }

    public function createInvitation(string $token)
    {
        $course = Course::where('token', $token)->firstOrFail();
        return view('main.master.create-invitation', compact('course'));
    }

    public function invitations(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'id_course' => 'required|integer|exists:courses,id',
            'email' => 'nullable|email|max:255',
        ], [
            'name.required' => 'El nombre del estudiante es obligatorio.',
            'name.max' => 'El nombre no puede exceder 255 caracteres.',
            'id_course.required' => 'El curso es obligatorio.',
            'id_course.exists' => 'El curso seleccionado no es válido.',
            'email.email' => 'El formato del email no es válido.',
            'email.max' => 'El email no puede exceder 255 caracteres.',
        ]);

        try {
            $invitation = Invitation::create([
                'name' => $request->name,
                'id_course' => $request->id_course,
                'email' => $request->email,
            ]);

            $code = base64_encode($invitation->name . '&' . $invitation->id);
            $invitation->code = $code;
            $invitation->save();

            return redirect()->route('master.invitations', ['token' => $request->route('token')])
                ->with('success', 'Invitación creada exitosamente para ' . $invitation->name . '. Código: ' . $code);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Ocurrió un error al crear la invitación. Por favor, intenta nuevamente.']);
        }
    }

    public function listInvitations(string $token)
    {
        $course = Course::where('token', $token)->firstOrFail();
        $invitations = Invitation::where('id_course', $course->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('main.master.invitations', compact('course', 'invitations'));
    }
}