<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Teacher;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        
        // Obtener roles del usuario usando consulta directa
        $userRoles = DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('model_has_roles.model_id', $user->id)
            ->where('model_has_roles.model_type', 'App\\Models\\User')
            ->pluck('roles.name')
            ->toArray();

        foreach ($roles as $role) {
            // Verificar rol de institution
            if ($role === 'institution' && in_array('institution', $userRoles)) {
                return $next($request);
            }

            // Verificar rol de user básico
            if ($role === 'user' && in_array('user', $userRoles)) {
                return $next($request);
            }

            // Verificar rol de master (teachers que pueden crear cursos)
            if ($role === 'master') {
                $isTeacher = Teacher::where('id_user', $user->id)->exists();
                if ($isTeacher) {
                    return $next($request);
                }
            }

            // Verificar rol de player (usuarios que no son teachers)
            if ($role === 'player') {
                $isTeacher = Teacher::where('id_user', $user->id)->exists();
                if (!$isTeacher && in_array('user', $userRoles)) {
                    return $next($request);
                }
            }
        }

        // Si el usuario no tiene ninguno de los roles especificados, retornar 403
        abort(403, 'No tienes permisos para acceder a esta página.');
    }
}