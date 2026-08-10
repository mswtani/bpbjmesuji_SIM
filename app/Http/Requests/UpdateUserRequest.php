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
         * Tidak boleh mengedit akun sendiri
         * melalui Manajemen User.
         */
        if ($targetUser->is($currentUser)) {
            return false;
        }

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

        /*
         * Target user harus berada di bawah level
         * user yang sedang login.
         */
        $currentLevel = $currentUser->role?->level ?? 0;
        $targetLevel = $targetUser->role?->level ?? 0;

        if ($targetLevel >= $currentLevel) {
            return false;
        }

        /*
         * Role baru yang akan diberikan.
         */
        $newRole = Role::find($this->input('role_id'));

        if (! $newRole) {
            return false;
        }

        /*
         * User hanya boleh memberikan role
         * yang levelnya lebih rendah dari dirinya.
         */
        return $newRole->level < $currentLevel;
    }


    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nip' => [
                'required',
                'max:30',
                Rule::unique('users', 'nip')
                    ->ignore($this->user),
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
                    ->ignore($this->user),
            ],

            'phone' => [
                'nullable',
                'max:20',
            ],

            'role_id' => [
                'required',
                'exists:roles,id',
            ],

            'position_id' => [
                'required',
                'exists:positions,id',
            ],
        ];
    }
}