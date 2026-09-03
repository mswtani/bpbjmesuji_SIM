<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegulationTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'name' => [
                'required',
                'string',
                'max:100',
                'unique:regulation_types,name',
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:1',
            ],

        ];
    }


    public function messages(): array
    {
        return [

            'name.required' => 'Nama jenis regulasi wajib diisi.',

            'name.max' => 'Nama jenis regulasi maksimal 100 karakter.',

            'name.unique' => 'Nama jenis regulasi tersebut sudah terdaftar. Silakan gunakan nama jenis regulasi yang berbeda.',

            'description.max' => 'Deskripsi maksimal 1000 karakter.',

            'is_active.required' => 'Status wajib dipilih.',

            'is_active.boolean' => 'Status yang dipilih tidak valid.',

            'sort_order.integer' => 'Urutan harus berupa angka.',

            'sort_order.min' => 'Urutan minimal bernilai 0.',

        ];
    }


    public function attributes(): array
    {
        return [

            'name' => 'nama jenis regulasi',

            'description' => 'deskripsi',

            'is_active' => 'status',

            'sort_order' => 'urutan',

        ];
    }
}