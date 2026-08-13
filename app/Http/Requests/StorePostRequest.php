<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
{
    /**
     * Determine whether the user is authorized
     * to create a post.
     */
    public function authorize(): bool
    {
        return $this->user()?->hasPermission('posts.create') ?? false;
    }

    /**
     * Get the validation rules.
     */
    public function rules(): array
    {
        $isRegulation =
            $this->input('type') === 'regulation';

        return [

            /*
            |--------------------------------------------------------------------------
            | Umum
            |--------------------------------------------------------------------------
            */

            'type' => [
                'required',
                'string',
                Rule::in([
                    'news',
                    'announcement',
                    'regulation',
                ]),
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'alpha_dash',
                'unique:posts,slug',
            ],

            'excerpt' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'content' => [
                'required',
                'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | Featured Image
            |--------------------------------------------------------------------------
            */

            'featured_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            /*
            |--------------------------------------------------------------------------
            | Data Regulasi
            |--------------------------------------------------------------------------
            */

            'regulation_type_id' => [
                Rule::requiredIf($isRegulation),
                'nullable',
                'integer',
                'exists:regulation_types,id',
            ],

            'regulation_number' => [
                Rule::requiredIf($isRegulation),
                'nullable',
                'string',
                'max:100',
            ],

            'regulation_year' => [
                Rule::requiredIf($isRegulation),
                'nullable',
                'integer',
                'min:1900',
                'max:2100',
            ],

            'regulation_date' => [
                Rule::requiredIf($isRegulation),
                'nullable',
                'date',
            ],

            /*
            |--------------------------------------------------------------------------
            | Status Hukum
            |--------------------------------------------------------------------------
            */

            'legal_status' => [
                Rule::requiredIf($isRegulation),
                'nullable',
                'string',

                Rule::in([
                    'berlaku',
                    'tidak_berlaku',
                    'mencabut',
                    'dicabut',
                    'mengubah',
                    'diubah',
                ]),
            ],

            /*
            |--------------------------------------------------------------------------
            | Hubungan Regulasi
            |--------------------------------------------------------------------------
            |
            | Untuk sementara validasi hubungan tetap dibuat fleksibel.
            | Logika hubungan banyak-ke-banyak akan kita sempurnakan
            | pada tahap berikutnya.
            |
            */

            'amends_post_id' => [
                'nullable',
                'integer',

                Rule::exists('posts', 'id')
                    ->where(function ($query) {
                        $query->where(
                            'type',
                            'regulation'
                        );
                    }),
            ],

            'repeals_post_id' => [
                'nullable',
                'integer',

                Rule::exists('posts', 'id')
                    ->where(function ($query) {
                        $query->where(
                            'type',
                            'regulation'
                        );
                    }),
            ],

            /*
            |--------------------------------------------------------------------------
            | PDF
            |--------------------------------------------------------------------------
            |
            | PDF belum wajib ketika Draft dibuat.
            | Validasi wajib PDF dilakukan ketika Publish.
            |
            */

            'document' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:10240',
            ],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [

            'type.required' =>
                'Jenis konten wajib dipilih.',

            'type.in' =>
                'Jenis konten tidak valid.',

            'title.required' =>
                'Judul wajib diisi.',

            'title.max' =>
                'Judul maksimal 255 karakter.',

            'slug.alpha_dash' =>
                'Slug hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah.',

            'slug.unique' =>
                'Slug tersebut sudah digunakan.',

            'excerpt.max' =>
                'Ringkasan maksimal 1000 karakter.',

            'content.required' =>
                'Isi konten wajib diisi.',

            'featured_image.image' =>
                'File gambar tidak valid.',

            'featured_image.mimes' =>
                'Gambar harus berformat JPG, JPEG, PNG, atau WebP.',

            'featured_image.max' =>
                'Ukuran gambar maksimal 2 MB.',

            /*
            |--------------------------------------------------------------------------
            | Regulasi
            |--------------------------------------------------------------------------
            */

            'regulation_type_id.required' =>
                'Jenis regulasi wajib dipilih.',

            'regulation_type_id.exists' =>
                'Jenis regulasi tidak valid.',

            'regulation_number.required' =>
                'Nomor regulasi wajib diisi.',

            'regulation_number.max' =>
                'Nomor regulasi maksimal 100 karakter.',

            'regulation_year.required' =>
                'Tahun regulasi wajib diisi.',

            'regulation_year.integer' =>
                'Tahun regulasi harus berupa angka.',

            'regulation_year.min' =>
                'Tahun regulasi tidak valid.',

            'regulation_year.max' =>
                'Tahun regulasi tidak valid.',

            'regulation_date.required' =>
                'Tanggal regulasi wajib diisi.',

            'regulation_date.date' =>
                'Tanggal regulasi tidak valid.',

            /*
            |--------------------------------------------------------------------------
            | Status Hukum
            |--------------------------------------------------------------------------
            */

            'legal_status.required' =>
                'Status hukum regulasi wajib dipilih.',

            'legal_status.in' =>
                'Status hukum regulasi tidak valid.',

            /*
            |--------------------------------------------------------------------------
            | Hubungan Regulasi
            |--------------------------------------------------------------------------
            */

            'amends_post_id.exists' =>
                'Regulasi yang diubah tidak valid.',

            'repeals_post_id.exists' =>
                'Regulasi yang dicabut tidak valid.',

            /*
            |--------------------------------------------------------------------------
            | PDF
            |--------------------------------------------------------------------------
            */

            'document.file' =>
                'Dokumen regulasi tidak valid.',

            'document.mimes' =>
                'Dokumen regulasi harus berupa PDF.',

            'document.max' =>
                'Ukuran dokumen PDF maksimal 10 MB.',
        ];
    }
}