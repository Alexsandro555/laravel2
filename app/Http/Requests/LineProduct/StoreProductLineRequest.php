<?php

namespace App\Http\Requests\LineProduct;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductLineRequest extends FormRequest
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
            'type_product_id' => 'required',
            'producer_id' => 'required',
            'name_line' => 'required',
            'sort' => 'required'
        ];
    }

}