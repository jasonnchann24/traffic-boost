<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // if (!$this->images) {
        //     $this->merge([
        //         'images' => [],
        //     ]);
        // }

        $this->merge([
            'slug' => Str::slug($this->title),
            'meta_tags' => [
                'meta_title' => $this->meta_title,
                'meta_description' => $this->meta_description,
            ],
        ]);

        if (request()->isMethod('POST')) {
            $this->merge([
                'view_counts' => 0
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'description' => ['required', 'string'],
            'meta_tags' => ['required', 'array'],
            'meta_tags.meta_title' => ['required', 'string'],
            'meta_tags.meta_description' => ['required', 'string'],
            'meta_image' => ['required', 'image'],
            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['required', 'string'],
            'view_counts' => ['sometimes', 'numeric']
        ];
    }
}
