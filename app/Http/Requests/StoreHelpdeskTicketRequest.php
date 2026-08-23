<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHelpdeskTicketRequest extends FormRequest
{
    /**
     * Authorization.
     *
     * Guest maupun user login diperbolehkan membuat tiket.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules.
     */
    public function rules(): array
    {
        return [
            /*
            |--------------------------------------------------------------------------
            | Identitas Pemohon
            |--------------------------------------------------------------------------
            */

            'requester_name' => [
                'required',
                'string',
                'max:150',
            ],

            'requester_email' => [
                'required',
                'email',
                'max:255',
            ],

            'requester_phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            /*
            |--------------------------------------------------------------------------
            | Isi Pengajuan
            |--------------------------------------------------------------------------
            */

            'subject' => [
                'required',
                'string',
                'max:255',
            ],

            'message' => [
                'required',
                'string',
                'min:10',
                'max:10000',
            ],

            /*
            |--------------------------------------------------------------------------
            | Lampiran
            |--------------------------------------------------------------------------
            */

            'attachments' => [
                'nullable',
                'array',
                'max:5',
            ],

            'attachments.*' => [
                'file',
                'max:10240',
                'mimes:pdf,doc,docx,jpg,jpeg,png,zip,rar',
            ],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'requester_name.required' =>
                'Nama wajib diisi.',

            'requester_name.max' =>
                'Nama maksimal 150 karakter.',

            'requester_email.required' =>
                'Email wajib diisi.',

            'requester_email.email' =>
                'Format email tidak valid.',

            'requester_phone.max' =>
                'Nomor HP maksimal 30 karakter.',

            'subject.required' =>
                'Subjek wajib diisi.',

            'subject.max' =>
                'Subjek maksimal 255 karakter.',

            'message.required' =>
                'Pesan wajib diisi.',

            'message.min' =>
                'Pesan minimal 10 karakter.',

            'message.max' =>
                'Pesan maksimal 10.000 karakter.',

            'attachments.array' =>
                'Lampiran tidak valid.',

            'attachments.max' =>
                'Maksimal 5 file dapat dilampirkan.',

            'attachments.*.file' =>
                'Lampiran harus berupa file.',

            'attachments.*.max' =>
                'Ukuran setiap lampiran maksimal 10 MB.',

            'attachments.*.mimes' =>
                'Format lampiran yang diperbolehkan adalah PDF, DOC, DOCX, JPG, JPEG, PNG, ZIP atau RAR.',
        ];
    }
}