<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display login form.
     */
    public function create(): View
    {
        return view('auth.login');
    }


    /**
     * Handle login request.
     */
    public function store(
        LoginRequest $request
    ): RedirectResponse {

        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();


        /*
        |--------------------------------------------------------------------------
        | Password sementara dari administrator
        |--------------------------------------------------------------------------
        */

        if ($user->must_change_password) {

            return redirect()
                ->route('password.change');

        }


        /*
        |--------------------------------------------------------------------------
        | Public User
        |--------------------------------------------------------------------------
        */

        if ($user->isPublic()) {

            /*
             * Public belum verifikasi email.
             */
            if (! $user->email_verified_at) {

                return redirect()
                    ->route('verification.notice');

            }

            return redirect()
                ->route('public.home');
        }


        /*
        |--------------------------------------------------------------------------
        | ASN / Internal User
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->intended(
                route(
                    'dashboard',
                    absolute: false
                )
            );
    }


    /**
     * Logout.
     */
    public function destroy(
        Request $request
    ): RedirectResponse {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('public.home');
    }
}