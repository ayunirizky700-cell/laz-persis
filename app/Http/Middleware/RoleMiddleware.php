<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Ubah semuanya jadi angka agar tidak error "string vs integer"
        $userRole = (int) $request->user()->role_id;
        $allowedRoles = array_map('intval', $roles);

        if (!in_array($userRole, $allowedRoles)) {
            abort(403, 'Maaf, Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}