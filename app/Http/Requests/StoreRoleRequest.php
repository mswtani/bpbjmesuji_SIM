<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
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
            'code' => [
                'required',
                'max:30',
                'unique:roles,code',
            ],

            'name' => [
                'required',
                'max:100',
            ],

            'description' => [
                'nullable',
                'max:255',
            ],

            'level' => [
                'required',
                'integer',
                'min:1',
                'max:255',
            ],
        ];
    }
}