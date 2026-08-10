<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePasswordChanged
{
    /**
     * Handle an incoming request.
     */
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        $user = $request->user();

        /*
         * User yang masih menggunakan password sementara
         * wajib mengganti password terlebih dahulu.
         *
         * Route password.change dikecualikan agar user
         * tetap dapat membuka halaman ganti password.
         */
        if (
            $user &&
            $user->must_change_password &&
            ! $request->routeIs('password.change')
        ) {
            return redirect()->route('password.change');
        }

        return $next($request);
    }
}