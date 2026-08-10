<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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

        /*
         * User harus mempunyai permission users.create.
         */
        if (! $currentUser->hasPermission('users.create')) {
            return false;
        }

        /*
         * Ambil role yang akan diberikan.
         */
        $role = Role::find($this->input('role_id'));

        if (! $role) {
            return false;
        }

        /*
         * SUPER_ADMIN boleh membuat user dengan role apa pun.
         */
        if ($currentUser->hasRole('SUPER_ADMIN')) {
            return true;
        }

        /*
         * User selain SUPER_ADMIN hanya boleh membuat
         * user dengan role yang levelnya lebih rendah.
         */
        $currentLevel = $currentUser->role?->level ?? 0;

        return $role->level < $currentLevel;
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
                Rule::unique('users', 'nip'),
            ],

            'name' => [
                'required',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
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

    /**
     * Pesan validasi.
     */
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

            'phone.max' => 'Nomor HP maksimal 20 karakter.',

            'role_id.required' => 'Role wajib dipilih.',
            'role_id.exists' => 'Role yang dipilih tidak valid.',

            'position_id.required' => 'Jabatan wajib dipilih.',
            'position_id.exists' => 'Jabatan yang dipilih tidak valid.',
        ];
    }
}