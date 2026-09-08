<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        $user->load([
            'role',
            'position',
        ]);

        return view('profile.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(
        ProfileUpdateRequest $request
    ): RedirectResponse {
        $user = $request->user();

        $data = $request->validated();

        /*
        |--------------------------------------------------------------------------
        | Avatar
        |--------------------------------------------------------------------------
        */

        $oldAvatar = $user->avatar;

        /*
        | Upload avatar baru.
        |
        | Foto baru disimpan terlebih dahulu.
        | Foto lama baru dihapus setelah file baru
        | berhasil disimpan.
        */
        if ($request->hasFile('avatar')) {

            $newAvatar = $request->file('avatar')
                ->store('avatars', 'public');

            $data['avatar'] = $newAvatar;

            /*
            | Hapus foto lama setelah foto baru berhasil
            | disimpan.
            */
            if (
                $oldAvatar &&
                $oldAvatar !== $newAvatar &&
                Storage::disk('public')->exists($oldAvatar)
            ) {
                Storage::disk('public')->delete($oldAvatar);
            }
        }

        /*
        | Hapus avatar jika tidak ada foto baru.
        */
        elseif (
            ($data['remove_avatar'] ?? false) &&
            $oldAvatar
        ) {

            if (
                Storage::disk('public')->exists($oldAvatar)
            ) {
                Storage::disk('public')->delete($oldAvatar);
            }

            $data['avatar'] = null;
        }

        /*
        |--------------------------------------------------------------------------
        | Jangan simpan field kontrol form ke database
        |--------------------------------------------------------------------------
        */

        unset($data['remove_avatar']);

        /*
        |--------------------------------------------------------------------------
        | Email
        |--------------------------------------------------------------------------
        */

        $user->fill($data);

        /*
        * Jika email berubah, verifikasi email harus diulang.
        */
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => [
                'required',
                'current_password',
            ],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}