<?php
namespace App\Http\Requests\Order;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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


  public function messages() {
    return [
      'required' => 'Поле обязательное для заполнения',
      'numeric' => 'Для поля допустимы только числовые значения',
      'accepted' => 'Примите соглашение'
    ];
  }


  /**
   * Validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'firstname' => 'required',
      'surname' => 'required',
      'email' => 'required',
      'patronymiс' => 'required',
      'tel' => 'required',
      'address' => 'required',
      'city' => 'required',
      'region' => 'required',
      'index' => 'required|numeric',
      'accept' => 'accepted',
      //'sex' => 'required',
    ];
  }

}