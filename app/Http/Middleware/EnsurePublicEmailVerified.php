<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePublicEmailVerified
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
         * Hanya Public User yang wajib
         * melakukan verifikasi email.
         */
        if (
            $user->isPublic()
            && ! $user->email_verified_at
        ) {
            return redirect()
                ->route('verification.notice');
        }

        return $next($request);
    }
}