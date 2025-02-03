<?php

namespace App\Http\Requests;

use App\Rules\FileTypeValidate;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $rules = [
            'name' => "required|unique:categories,name|regex:/^[a-z\-_\s]+$/i",
            'status' => "required|" . Rule::in(['1', '0']),
        ];

        if (request()->method() == "POST") {
            $rules['image'] = ['required', 'max:3072', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG','gif'])];
        }
        
        if (request()->method() == "PUT") {
            $rules['name'] = "required|unique:categories,name," . $this->category->id;
            $rules['image'] = ['max:3072','image', new FileTypeValidate(['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG','gif'])];
        }
        return $rules;
    }
}
