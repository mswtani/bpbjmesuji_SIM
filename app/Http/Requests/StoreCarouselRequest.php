<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCarouselRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()?->hasPermission('carousels.create') ?? false;
    }

    public function rules(): array
    {
        return [
            'post_id' => [
                'required',
                'integer',
                'exists:posts,id',
                Rule::unique('carousels', 'post_id'),
            ],

            'banner' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
                'dimensions:min_width=1200,min_height=450',
            ],

            'caption_type' => [
                'required',
                Rule::in([
                    'auto',
                    'custom',
                    'none',
                ]),
            ],

            'custom_title' => [
                'nullable',
                'string',
                'max:255',
                'required_if:caption_type,custom',
            ],

            'custom_description' => [
                'nullable',
                'string',
                'required_if:caption_type,custom',
            ],

            'show_button' => [
                'nullable',
                'boolean',
            ],

            'button_text' => [
                'nullable',
                'string',
                'max:100',
                'required_if:show_button,1',
            ],

            'sort_order' => [
                'required',
                'integer',
                'min:1',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'starts_at' => [
                'nullable',
                'date',
            ],

            'ends_at' => [
                'nullable',
                'date',
                'after_or_equal:starts_at',
            ],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'show_button' => $this->boolean('show_button'),
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}