<?php
namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UploadProductRequest extends FormRequest
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
            'photo' => 'image|mimes:jpeg,bmp,png|max:2000',
        ];
    }
}