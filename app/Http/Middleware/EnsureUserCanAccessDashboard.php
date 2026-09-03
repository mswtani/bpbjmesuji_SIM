<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserCanAccessDashboard
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        /*
         * Public user tidak memiliki akses
         * ke dashboard administrasi.
         */
        if ($user->isPublic()) {
            return redirect()
                ->route('home')
                ->with(
                    'error',
                    'Akun public tidak memiliki akses ke Dashboard Administrasi.'
                );
        }

        return $next($request);
    }
}