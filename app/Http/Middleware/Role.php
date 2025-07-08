<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    public function handle(Request $request, Closure $next, ...$rolesPermitidos)
    {
        $user = auth()->user();

        if (!$user || !$user->role) {
            abort(403, 'Acesso não autorizado.');
        }

        $userRole = strtolower($user->role->nome);
        $rolesPermitidos = array_map('strtolower', $rolesPermitidos);

        if (!in_array($userRole, $rolesPermitidos)) {
            abort(403, 'Acesso não autorizado.');
        }

        return $next($request);
    }
}
