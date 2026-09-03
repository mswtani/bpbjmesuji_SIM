<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsApproved
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->isRejected()) {
            auth()->logout();

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Akun Anda ditolak. Silakan hubungi administrator.'
                );
        }

        if ($user->isPendingApproval()) {
            auth()->logout();

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Akun Anda masih menunggu persetujuan administrator.'
                );
        }

        if (! $user->isApproved()) {
            auth()->logout();

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Akun Anda belum mendapatkan persetujuan.'
                );
        }

        return $next($request);
    }
}