<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class RestrictToAdminPanel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && session()->get('logged_via_admin') === true) {
            // Lista de patrones de nombres de rutas permitidas para el panel de administración
            $allowedRoutes = [
                'dashboard',
                'usuarios.*',
                'actividades.*',
                'album.index',
                'fotos.destroy',
                'profile.*',
                'logout',
            ];

            $currentRouteName = $request->route() ? $request->route()->getName() : '';

            // Si no tiene nombre de ruta o no coincide con los permitidos, redireccionar
            $isAllowed = false;
            foreach ($allowedRoutes as $allowed) {
                if (Str::is($allowed, $currentRouteName)) {
                    $isAllowed = true;
                    break;
                }
            }

            if (!$isAllowed) {
                return redirect()->route('dashboard')->with('error', 'Solo tienes acceso al panel de administración.');
            }
        }

        return $next($request);
    }
}
