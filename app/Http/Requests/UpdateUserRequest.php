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
        ];
    }
}