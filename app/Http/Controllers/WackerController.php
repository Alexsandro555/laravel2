<?php
namespace App\Http\Controllers;

use App\File;
use App\ProducerTypeProduct;
use App\TestClass;
use App\TypeProduct;
use App\Product;
use App\News;

class WackerController extends Controller
{
    public function index() {

      //$test = new TestClass();
      //$user_id = $test->getCurentUser();
      $news = News::take(2)->get();
      $typeProducts = TypeProduct::with('files')->get();
      return view('wacker.index', compact('typeProducts','news'));
    }

    public function catalogStatic() {
      return view('wacker.staticCatalog');
    }

  public function details() {
    return view('wacker.details');
  }

  public function catalog($id) {
    $typeProduct = TypeProduct::find($id);
    $producerTypeProducts = ProducerTypeProduct::with('files')->where('type_product_id',$id)->get();
    $productLine = [];
    foreach ($producerTypeProducts as $producerTypeProduct)
    {
      $tempArr['products'] = Product::with('files.typeFile')->where('producer_type_product_id',$producerTypeProduct->id)->get();
      if($tempArr['products']->first())
      {
        $tempArr['id'] = $producerTypeProduct->id;
        $tempArr['title']= $producerTypeProduct->name_line;
        $productLine[] = $tempArr;
      }
    }
    $news = News::take(2)->get();
    return view('wacker.catalog', compact('producerTypeProducts','productLine', 'typeProduct', 'news'));
  }

    public function detail($slug) {
      $news = News::take(2)->get();
      $product = Product::with(['files','attributes'])->where('url_key',$slug)->first();
      return view('wacker.detail',compact('product','news'));
    }
}