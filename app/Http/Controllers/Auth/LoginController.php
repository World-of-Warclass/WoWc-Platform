<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();

            // Verificar roles usando consulta directa
            $roleNames = DB::table('model_has_roles')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->where('model_has_roles.model_id', $user->id)
                ->where('model_has_roles.model_type', 'App\\Models\\User')
                ->pluck('roles.name')
                ->toArray();
            
            // Verificar si es teacher (master)
            $isTeacher = Teacher::where('id_user', $user->id)->exists();
            
            if (in_array('institution', $roleNames)) {
                return redirect()->intended('/institution');
            } elseif ($isTeacher) {
                // Si es teacher, puede acceder como master
                return redirect()->intended('/dashboard');
            } elseif (in_array('user', $roleNames)) {
                // Si es user regular, puede acceder como player
                return redirect()->intended('/dashboard');
            } else {
                return back()->withErrors([
                    'email' => 'No tienes permisos para acceder a esta aplicación.',
                ]);
            }
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    public function logout(Request $request)
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
