<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Menampilkan halaman reset password.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', [
            'request' => $request,
        ]);
    }

    /**
     * Memproses password baru dari fitur lupa password.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => [
                'required',
            ],

            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],
        ]);

        $status = Password::reset(
            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),

            function (User $user) use ($request) {

                /*
                |--------------------------------------------------------------------------
                | Reset password dari email
                |--------------------------------------------------------------------------
                |
                | User membuat password sendiri melalui link
                | forgot password, sehingga:
                |
                | - password diperbarui
                | - remember token diperbarui
                | - tidak perlu lagi wajib ubah password
                |
                */

                $user->forceFill([
                    'password' => Hash::make(
                        $request->password
                    ),

                    'remember_token' => Str::random(60),

                    'must_change_password' => false,
                ])->save();

                event(new PasswordReset($user));
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Reset berhasil
        |--------------------------------------------------------------------------
        */

        if ($status === Password::PASSWORD_RESET) {

            return redirect()
                ->route('login')
                ->with(
                    'status',
                    'Password berhasil direset. Silakan login menggunakan password baru Anda.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Reset gagal
        |--------------------------------------------------------------------------
        */

        return back()
            ->withInput(
                $request->only('email')
            )
            ->withErrors([
                'email' => __($status),
            ]);
    }
}