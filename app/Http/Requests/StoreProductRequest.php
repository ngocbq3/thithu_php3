<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => ['required', 'unique:products,name'],
            'description' => ['required'],
            'price' => ['required', 'decimal:0, 20000000000'],
            'quantity' => ['required', 'integer'],
            'image' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
