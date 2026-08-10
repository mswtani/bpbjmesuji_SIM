<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserCanManageUsers
{
    /**
     * Handle an incoming request.
     */
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        $user = $request->user();

        if (
            ! $user ||
            ! $user->hasPermission('users.view')
        ) {
            abort(
                403,
                'Anda tidak memiliki izin untuk mengelola user.'
            );
        }

        return $next($request);
    }
}