<?php
namespace App\Http\Controllers\LineProduct;

use App\Http\Controllers\Controller;
use App\FileHandler;
use App\File;
use App\TypeProduct;
use App\Producer;
use App\ProducerTypeProduct;
use Illuminate\Http\Request;
use App\Http\Requests\LineProduct\StoreProductLineRequest;
use App\Http\Requests\LineProduct\UpdateProductLineRequest;

class LineProductController extends Controller
{
  /**
   *
   * Add Product Line
   */
  public function add()
  {
    $typeProducts = TypeProduct::all()->pluck('title','id');
    $producers = Producer::all()->pluck('title','id');
    return view('product.line.add', compact('typeProducts','producers'));
  }

  /**
   *
   * Add Product Line Handler
   * @param StoreProductLineRequest $productLineRequest
   * @return \Illuminate\Http\Redirect
   */
  public function addHandler(StoreProductLineRequest $productLineRequest)
  {
    $file = $productLineRequest->file('file');
    $request = $productLineRequest->except(['_token','file']);
    $producerTypeProduct = ProducerTypeProduct::create($request);
    $id = $producerTypeProduct->id;
    if($file) {
      $fileHandler = new FileHandler();
      $fileHandler->upload($file, false, 'App\ProducerTypeProduct', $id);
    }
    return redirect()->route('update-line',['id' => $id]);
  }

  /**
   *  Update Product Line
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update($id)
  {
    $id = (int)$id;
    $typeProducts = TypeProduct::all()->pluck('title','id');
    $producers = Producer::all()->pluck('title','id');
    $line = ProducerTypeProduct::find($id);
    $file = File::where('fileable_id',$id)->where('fileable_type','App\ProducerTypeProduct')->first();
    return view('product.line.add', compact('line', 'producers', 'file', 'typeProducts'));
  }

  /**
   *
   * Update Product Line Handl
   * @param int $id
   * @param Request $request
   * @return \Illuminate\Http\Redirect
   */
  public function updateHandler($id, UpdateProductLineRequest $request)
  {
    $file = $request->file;
    $id = (int)$id;
    $producerTypeProductRequest = $request->except('_token','file');
    ProducerTypeProduct::where('id', $id)->update($producerTypeProductRequest);
    if($file) {
      $currentFile = File::where('fileable_id',$id)->where('fileable_type','App\ProducerTypeProduct')->first();
      if($currentFile)
      {
        $currentFile->delete();
      }
      $fileHandler = new FileHandler();
      $fileHandler->upload($file, false, 'App\ProducerTypeProduct',$id);
    }
    return redirect()->route('list-categories',['id' => 1]);
  }


  /**
   * Line Products
   * @return \Illuminate\Http\Response
   */
  public function showList() {
    $producerTypeProducts = ProducerTypeProduct::All();
    return view('product.line.list',compact('producerTypeProducts'));
  }


  /**
   * Получение линейки продукции для заданного типа продукции
   */
  public function get($id) {
    $arrProductLine = ProducerTypeProduct::where('type_product_id',$id)->get();
    return $arrProductLine;
  }
}