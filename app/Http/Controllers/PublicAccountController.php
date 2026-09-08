<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PublicAccountController extends Controller
{
    /**
     * Menampilkan halaman Setting Akun Public User.
     */
    public function edit(): View
    {
        return view('public.account.edit', [
            'user' => request()->user(),
        ]);
    }

    /**
     * Memperbarui informasi akun Public User.
     */
    public function update(
        ProfileUpdateRequest $request
    ): RedirectResponse {
        $user = $request->user();

        $data = $request->validated();

        $oldAvatar = $user->avatar;

        /*
        |--------------------------------------------------------------------------
        | Avatar baru
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('avatar')) {
            $newAvatar = $request->file('avatar')
                ->store('avatars', 'public');

            $data['avatar'] = $newAvatar;

            if (
                $oldAvatar &&
                $oldAvatar !== $newAvatar &&
                Storage::disk('public')->exists($oldAvatar)
            ) {
                Storage::disk('public')->delete($oldAvatar);
            }
        } elseif (
            ($data['remove_avatar'] ?? false) &&
            $oldAvatar
        ) {
            if (Storage::disk('public')->exists($oldAvatar)) {
                Storage::disk('public')->delete($oldAvatar);
            }

            $data['avatar'] = null;
        }

        unset($data['remove_avatar']);

        /*
        |--------------------------------------------------------------------------
        | Simpan informasi akun
        |--------------------------------------------------------------------------
        */

        $user->fill($data);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('public.account.edit')
            ->with('status', 'account-updated');
    }
}