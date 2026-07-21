<?php

namespace App\Http\Requests;

use App\Support\GoogleMapsUrlParser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AreaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $coordinates = GoogleMapsUrlParser::coordinatesFromUrl(
            $this->input('google_map_url')
        );

        if ($coordinates === null) {
            return;
        }

        $this->merge($coordinates);
    }

    public function rules(): array
    {
        $area = $this->route('area');

        return [
            'country_side_id' => [
                'required',
                'integer',
                'exists:country_sides,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('areas', 'slug')
                    ->ignore($area?->id),
            ],

            'lat' => [
                'nullable',
                'numeric',
                'between:-90,90',
            ],

            'lng' => [
                'nullable',
                'numeric',
                'between:-180,180',
            ],

            'google_map_url' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'address' => [
                'nullable',
                'string',
                'max:255',
            ],

            'open_hours' => [
                'nullable',
                'string',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'serves' => [
                'nullable',
                'string',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'secondary_phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'facebook' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'instagram' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'is_recommended' => [
                'nullable',
                'boolean',
            ],

            'photos' => [
                'nullable',
                'array',
                'max:5',
            ],

            'photos.*' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'remove_photos' => [
                'nullable',
                'array',
            ],

            'remove_photos.*' => [
                'integer',
                'exists:area_images,id',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'slug.regex' => 'The slug may only contain lowercase letters, numbers and hyphens.',

            'photos.max' => 'You can upload a maximum of five photos.',

            'photos.*.image' => 'Every uploaded file must be an image.',

            'photos.*.mimes' => 'Photos must be JPG, JPEG, PNG or WEBP.',

            'photos.*.max' => 'Each photo must not be larger than 5 MB.',
        ];
    }
}
