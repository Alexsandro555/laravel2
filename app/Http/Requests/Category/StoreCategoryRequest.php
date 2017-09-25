<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{

    /**
     * Determine if the user is authorized
     *
     * @return bool
     */
    /**
     * @param string $pathInfo
     */
    public function authorize()
    {
        return true;
    }


    /**
     * Validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'url_key' => 'required|unique:categories',
            'description' => '',
            'image' => 'image|max:1000|mimes:jpeg,jpg,png',
            'active' => 'boolean',
            'sort' => 'numeric',
            'parent' => 'required'
        ];
    }

}