<?php
namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderRequest;

class OrderController extends Controller
{
  /**
   * Show Order Form
   */
  public function index() {
    return view('order.index');
  }

  /**
   * Order Handler
   * @param OrderRequest $orderRequest
   */
  public function handler(OrderRequest $orderRequest) {
    $arr = $orderRequest->all();
    return true;
  }
}