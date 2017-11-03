<?php
namespace App\Http\Controllers;

use App\Http\Requests\Product\UploadProductRequest;
use App\ProductPhoto;
use Intervention\Image\ImageManager;
use App\File;
use App\Services\ProductService;

class UploadController extends Controller
{
  public function uploadHandl(ProductService $product, UploadProductRequest $request) {
    $file = $product->uploadFile($request->file('file'), $request->elementId, $request);
    return response()->json(['error'=> false, 'id'=> $file->id, 'code' => 200], 200);
  }

  /**
   *  Get Files
   * @param int $id
   * @return \Illuminate\Http\Response:json
   */
  public function getFiles($id)
  {
    $id = (int)$id;
    /*$image = File::with(['typeFile' => function($query) {
      $query->where('id', 1);
    }])->where('fileable_id',$id)->get();*/
    $image = File::with(['typeFile' => function($query){
      $query->where('name','dropzoneimage');
    }])->where('fileable_id',$id)->get();
    //$image = File::with('typeFile')->where('fileable_id', $id)->get();
    return response()->json($image,200);
  }

  /**
   *  Delete Image
   * @param int $id
   * @return \Illuminate\Http\Response:json
   */
  public function deleteFile($id)
  {
    $id = (int)$id;
    /*$file = File::find($id);
    $files = File::where('fileable_id',$file->fileable_id)->get();
    foreach ($files as $file) {
      $file->delete();
    }*/
    $file = File::find($id);
    $baseName = stristr($file->config['filename'], '-', true);
    $baseName = $baseName."%";

    //$files = File::where('fileable_type','like',"App%")->get();
    //$files = File::where('config->filename','like',$baseName)->get();
    $files = File::where(function($query) {
      $query->where('config->filename','like',$baseName);
    })->get();
    /*foreach ($files as $file) {
      $file->delete();
    }*/
    return response()->json([],200);
  }
}