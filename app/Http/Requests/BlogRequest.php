<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'post' => [
                'required',
                // Rule::unique("blogs")->ignore($this->route("blog")),
                'min:5',
                'max:100',
            ],
            'image' => [
               'image:jpg, jpeg, png',
               'max:512', 
            ],
        ];
    }
    public function messages()
    {
        return [
            'post.unique' => "The post must be unique."
        ];   
    }
}
