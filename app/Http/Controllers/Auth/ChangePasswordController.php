<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ChangePasswordController
{
    /**
     * Menampilkan halaman ubah password.
     */
    public function edit(): View
    {
        return view('auth.change-password');
    }

    /**
     * Menyimpan password baru.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'current_password' => [
                    'required',
                    'current_password',
                ],

                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'confirmed',
                    'different:current_password',
                ],
            ],
            [
                'current_password.required' =>
                    'Password saat ini wajib diisi.',

                'current_password.current_password' =>
                    'Password saat ini tidak benar.',

                'password.required' =>
                    'Password baru wajib diisi.',

                'password.min' =>
                    'Password baru minimal 8 karakter.',

                'password.confirmed' =>
                    'Konfirmasi password tidak cocok.',

                'password.different' =>
                    'Password baru harus berbeda dari password saat ini.',
            ]
        );

        $user = $request->user();

        /*
         * Simpan password baru dan tandai bahwa
         * user tidak lagi wajib mengganti password.
         */
        $user->update([
            'password' => Hash::make($request->password),
            'must_change_password' => false,
        ]);

        /*
         * Regenerasi session setelah password berhasil diubah.
         */
        $request->session()->regenerate();

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Password berhasil diubah. Selamat datang kembali.'
            );
    }
}