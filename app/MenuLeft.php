<?php
namespace App;

use App\TypeProduct;

class MenuLeft
{
  public static function getMenu()
  {
    $typeProducts = TypeProduct::All();
    return $typeProducts;
  }
}