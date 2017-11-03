<?php
/**
 * Created by PhpStorm.
 * User: alexsandro
 * Date: 02.11.17
 * Time: 9:28
 */

namespace App\Services;

use App\Services\FileUploadService;
use App\File;

class ProductService
{
  public function uploadFile($file, $id, $request) {
    if($file)
    {
      $uploadService = new FileUploadService($file, $id, 'App\Product', $request);
      $result = $uploadService->resize();
      if(!$result) {
        return response()->json([
          'error' => true,
          'code' => 500,
          'message' => $uploadService->validator->errors()->first()
      ],500);
      }
      return $result;
    }
  }
}