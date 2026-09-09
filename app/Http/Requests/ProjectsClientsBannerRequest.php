<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectsClientsBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image'        => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'title'        => 'required|string|max:255',
            'content'      => 'required|string|max:1000',
            'description'  => 'required|string|max:2000',
        ];
    }
}
