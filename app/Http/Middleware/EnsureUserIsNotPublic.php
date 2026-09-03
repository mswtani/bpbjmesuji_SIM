<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsNotPublic
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->isPublic()) {
            return redirect()
                ->route('home')
                ->with(
                    'error',
                    'Akun Public tidak memiliki akses ke dashboard administrasi.'
                );
        }

        return $next($request);
    }
}