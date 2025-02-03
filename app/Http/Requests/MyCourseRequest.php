<?php

namespace App\Http\Requests;

use App\Rules\FileTypeValidate;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MyCourseRequest extends FormRequest
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
            'category_id' => "required|numeric",
            'course_id' => "required|numeric",
            'discount' => "required|decimal:2,4",
            'level' => "required|number". Rule::in(['1', '2','3']),
            'value' => "required|" . Rule::in(['0', '1']),
            'status' => "required|" . Rule::in(['1', '0']),
            'price' => "required|decimal:2,4",
            'preview_video' => "required|". Rule::in(['1', '2']),
            'upload_video' => "mimes:mp4|required_if:preview_video,1",
            'video_url' => "required_if:preview_video,2",
            'tags' => "required|array",
            'tags.*' => "required",
            'description' => "required|string"
        ];

        if (request()->method() == "POST") {
            $rules['title'] =  "required|unique:lessons,title|regex:/^[a-z\-_\s]+$/i";
            $rules['image'] = ['required', 'max:3072', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG','gif'])];
        }
        
        if (request()->method() == "PUT") {
            $rules['title'] = ["required","regex:/^[a-z\-_\s]+$/i","unique:lessons,title," . $this->my_course->id];
            $rules['image'] = ['max:3072','image', new FileTypeValidate(['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG','gif'])];
        }
        return $rules;
    }
}
