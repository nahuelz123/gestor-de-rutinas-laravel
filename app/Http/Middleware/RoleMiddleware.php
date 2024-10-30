<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Maneja una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirige al login si no está autenticado
        }

        // Obtiene el rol del usuario autenticado
        $userRole = Auth::user()->role;

        // Verifica si el rol del usuario está en los roles permitidos
        if (!in_array($userRole, $roles)) {
            abort(403, 'Acceso denegado. No tienes permisos para acceder a esta página.');
        }

        return $next($request);
    }
}
