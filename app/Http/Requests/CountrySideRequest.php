<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountrySideRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $countrySide = $this->route('country_side')
            ?? $this->route('countrySide');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('country_sides', 'slug')
                    ->ignore($countrySide?->id),
            ],

            'center_lat' => [
                'nullable',
                'numeric',
                'between:-90,90',
            ],

            'center_lng' => [
                'nullable',
                'numeric',
                'between:-180,180',
            ],

            'zoom' => [
                'required',
                'integer',
                'between:1,20',
            ],

            'position_top' => [
                'nullable',
                'numeric',
                'between:0,100',
            ],

            'position_left' => [
                'nullable',
                'numeric',
                'between:0,100',
            ],

            'label_position' => [
                'required',
                Rule::in(['top', 'right', 'bottom', 'left']),
            ],
        ];
    }
}
