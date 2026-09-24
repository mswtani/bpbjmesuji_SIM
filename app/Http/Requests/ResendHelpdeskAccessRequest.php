<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResendHelpdeskAccessRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'ticket_number' => [
                'required',
                'string',
                'max:30',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
            ],
        ];
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            'ticket_number.required' =>
                'Nomor tiket wajib diisi.',

            'ticket_number.max' =>
                'Nomor tiket tidak valid.',

            'email.required' =>
                'Alamat email wajib diisi.',

            'email.email' =>
                'Alamat email tidak valid.',

            'email.max' =>
                'Alamat email tidak valid.',
        ];
    }
}