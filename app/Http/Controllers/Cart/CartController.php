<?php
namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Cart;
use App\File;

class CartController extends Controller
{
  /**
   *
   * Add Product to Cart
   *
   * @return Array
   */
  public function add($id) {
    $product = Product::with('files')->find($id);
    $filename = "";
    if(count($product->files)>0) {
      foreach($product->files as $file)
      {
        $filename = $file->filename;
        break;
      }
    }
    Cart::add($product->id, $product->title, $product->qty, $product->price,['article'=>$product->article, 'slug'=>$product->url_key, 'filename'=>$filename!=""?$filename:"no-image.png"]);
    $total = Cart::subtotal();
    $count = Cart::count();
    return ["total"=>$total,"count"=>$count];
  }

  /**
   *
   * Get Current Cart Total
   * @return Array
   */
  public function current() {
    $total = Cart::subtotal();
    $count = Cart::count();
    return ["total"=>$total,"count"=>$count];
  }


  /**
   * Show Cart
   */
  public function index() {
    $cart = Cart::content()->toArray();
    $arr = [];
    foreach($cart as $elem) {
      $arr[] = $elem;
    }
    return view('cart.index', compact('arr'));
  }


  /**
   * Delete Element Cart
   */
  public function delete(Request $request) {
    $rowId = $request->rowId;
    $cart = Cart::content()->toArray();
    try {
      Cart::remove($rowId);
    }
    catch (\Exception $e) {
      $error = $e-getMessage();
    }
    return [];
  }

  /**
   * Up Qty Cart Element
   */
  public function upQty($id,$qty) {
    Cart::update($id,$qty);
    return [];
  }

  /**
   * Down Qty Cart Element
   */
  public function downQty($id,$qty) {
    Cart::update($id,$qty);
    return [];
  }

  public function updateQty($id,$qty) {
    $product = Product::with('files')->find($id);
    $filename = "";
    if(count($product->files)>0) {
      foreach($product->files as $file)
      {
        $filename = $file->filename;
        break;
      }
    }
    Cart::add($product->id, $product->title, $qty, $product->price,['article'=>$product->article, 'slug'=>$product->url_key, 'filename'=>$filename!=""?$filename:"no-image.png"]);
    return [];
  }
}