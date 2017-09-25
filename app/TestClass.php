<?php
namespace App;

use Illuminate\Support\Facades\Auth;

class TestClass
{
  function __construct()
  {

  }

  function getCurentUser()
  {
    return Auth::user()->id;
  }
}