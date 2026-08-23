<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHelpdeskMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'message' => [
                'required',
                'string',
                'max:5000',
            ],

            'attachments' => [
                'nullable',
                'array',
                'max:5',
            ],

            'attachments.*' => [
                'file',
                'max:10240',
                'mimes:pdf,jpg,jpeg,png,zip',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'message.required' =>
                'Pesan wajib diisi.',

            'message.string' =>
                'Pesan tidak valid.',

            'message.max' =>
                'Pesan maksimal 5000 karakter.',

            'attachments.array' =>
                'Format lampiran tidak valid.',

            'attachments.max' =>
                'Maksimal 5 file dapat dilampirkan.',

            'attachments.*.file' =>
                'Lampiran tidak valid.',

            'attachments.*.max' =>
                'Ukuran setiap lampiran maksimal 10 MB.',

            'attachments.*.mimes' =>
                'Lampiran hanya boleh berupa PDF, JPG, JPEG, PNG, atau ZIP.',
        ];
    }
}