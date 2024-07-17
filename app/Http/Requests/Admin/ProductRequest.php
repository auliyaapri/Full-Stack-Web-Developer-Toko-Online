<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'users_id' => 'required|integer|exists:users,id',
            'categories_id' => 'required|integer|exists:categories,id',
            'price' => 'required|integer',
            'description' => 'required',
            'photo' => 'nullable|image|max:3072', // 3MB = 3072KB
            'photos' => 'nullable|image|max:3072', // Untuk uploadGallery
        ];
    }
}
