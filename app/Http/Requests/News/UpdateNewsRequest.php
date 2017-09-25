<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
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
    ];
  }

}