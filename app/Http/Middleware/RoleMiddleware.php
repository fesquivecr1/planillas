<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$roles): Response
    {
        $user = $request->user();

        // No autenticado
        if (!$user) {
            abort(403, 'No autorizado');
        }

        // Verificar roles
        if (!$user->hasAnyRole($roles)) {
            abort(403, 'No tiene permisos para acceder a este módulo');
        }

        return $next($request);
    }
    
}
