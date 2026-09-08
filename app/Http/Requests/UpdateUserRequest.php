<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $currentUser = $this->user();

        if (! $currentUser) {
            return false;
        }

        $targetUser = $this->route('user');

        if (! $targetUser) {
            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | Public User
        |--------------------------------------------------------------------------
        |
        | Public user tidak dapat mengubah role, NIP,
        | dan jabatan melalui form.
        |
        */

        if ($targetUser->user_type === 'public') {

            /*
            * SUPER_ADMIN dapat mengelola public user.
            */
            if ($currentUser->hasRole('SUPER_ADMIN')) {
                return true;
            }

            /*
            * Selain SUPER_ADMIN harus memiliki
            * permission users.update.
            */
            if (! $currentUser->hasPermission('users.update')) {
                return false;
            }

            $currentLevel = $currentUser->role?->level ?? 0;
            $targetLevel = $targetUser->role?->level ?? 0;

            return $targetLevel < $currentLevel;
        }

        /*
        |--------------------------------------------------------------------------
        | User ASN / Internal
        |--------------------------------------------------------------------------
        */

        /*
        * SUPER_ADMIN boleh mengedit user lain.
        */
        if ($currentUser->hasRole('SUPER_ADMIN')) {
            return true;
        }

        /*
        * Harus mempunyai permission users.update.
        */
        if (! $currentUser->hasPermission('users.update')) {
            return false;
        }

        $currentLevel = $currentUser->role?->level ?? 0;
        $targetLevel = $targetUser->role?->level ?? 0;

        /*
        * Target harus berada di bawah level user
        * yang sedang login.
        */
        if ($targetLevel >= $currentLevel) {
            return false;
        }

        /*
        * Role baru yang akan diberikan.
        */
        $newRole = Role::find(
            $this->input('role_id')
        );

        if (! $newRole) {
            return false;
        }

        /*
        * Role baru harus lebih rendah.
        */
        return $newRole->level < $currentLevel;
    }


    public function rules(): array
    {
        $targetUser = $this->route('user');

        $isPublic = $targetUser?->user_type === 'public';

        return [
            'nip' => $isPublic
                ? [
                    'nullable',
                ]
                : [
                    'required',
                    'max:30',
                    Rule::unique('users', 'nip')
                        ->ignore($targetUser),
                ],

            'name' => [
                'required',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($targetUser),
            ],

            'role_id' => $isPublic
                ? [
                    'nullable',
                ]
                : [
                    'required',
                    'exists:roles,id',
                ],

            'position_id' => $isPublic
                ? [
                    'nullable',
                ]
                : [
                    'required',
                    'exists:positions,id',
                ],
            'avatar' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:2048',
                ],

            'remove_avatar' => [
                    'nullable',
                    'boolean',
                ],
        ];
    }

    public function messages(): array
    {
        return [
            'nip.required' => 'NIP wajib diisi.',
            'nip.max' => 'NIP maksimal 30 karakter.',
            'nip.unique' => 'NIP sudah digunakan oleh user lain.',

            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama maksimal 255 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'email.unique' => 'Email sudah digunakan oleh user lain.',

            'role_id.required' => 'Role wajib dipilih.',
            'role_id.exists' => 'Role yang dipilih tidak valid.',

            'position_id.required' => 'Jabatan wajib dipilih.',
            'position_id.exists' => 'Jabatan yang dipilih tidak valid.',

            // Foto Profil
            'avatar.image' => 'File foto profil harus berupa gambar.',
            'avatar.mimes' => 'Foto profil harus berformat JPG, JPEG, PNG, atau WEBP.',
            'avatar.max' => 'Ukuran foto profil maksimal 2 MB.',
        ];
    }
}