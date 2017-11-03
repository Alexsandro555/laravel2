<?php
namespace App;


use Intervention\Image\ImageManager;
use App\File;
use Illuminate\Support\Facades\Storage;

class FileHandler
{
  private $path = "app/public/";

  public function upload($file, $resize, $model, $id, $typeFileId, $width=null, $height=null)
  {
    $originalName = $file->getClientOriginalName();
    $extension = $file->getClientOriginalExtension();
    $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) -1);
    $filename = $this->sanitize($originalNameWithoutExt);
    $allowed_filename = $this->createUniqueFilename($filename, $extension );
    if($resize) {
      $uploadiconSuccess = $this->icons($file, $allowed_filename, $width, $height, $this->path);
      if(!$uploadiconSuccess) {
        return false;
      }
      $size = $this->size($file);
    }
    else
    {
      $uploadSuccess = $this->move($file, $allowed_filename );
      if(!$uploadSuccess)
      {
        return false;
      }
    }

    $file = new File();
    $file->fileable_id = $id;
    $file->fileable_type = $model;
    $file->type_file_id = $typeFileId;
    $conf['filename'] = $allowed_filename;
    //if($size) $conf['size'] = $size;
    $file->config = $conf;
    $file->save();
    return $file;
  }

  private function sanitize($string, $force_lowercase = true, $anal = false)
  {
    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
      "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
      "â€”", "â€“", ",", "<", ".", ">", "/", "?");
    $clean = trim(str_replace($strip, "", strip_tags($string)));
    $clean = preg_replace('/\s+/', "-", $clean);
    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

    return ($force_lowercase) ?
      (function_exists('mb_strtolower')) ?
        mb_strtolower($clean, 'UTF-8') :
        strtolower($clean) :
      $clean;
  }

  private function createUniqueFilename( $filename, $extension )
  {
    $full_size_dir = storage_path($this->path);
    $full_image_path = $full_size_dir . $filename . '.' . $extension;

    if ( file_exists( $full_image_path ) )
    {
      // Generate token for image
      $imageToken = substr(sha1(mt_rand()), 0, 5);
      return $filename . '-' . $imageToken . '.' . $extension;
    }
    return $filename . '.' . $extension;
  }

  private function size( $photo )
  {
    $manager = new ImageManager();
    $image = $manager->make( $photo );
    $size = $image->filesize();
    return $size;
  }

  private function move( $photo, $filename )
  {
    Storage::putFileAs('public',$photo,$filename);
    return $filename;
  }

  private function icons( $photo, $filename, $width, $height, $path )
  {
    $manager = new ImageManager();
    $image = $manager->make( $photo )->resize($width,$height)->save(storage_path($this->path) . $filename );
    return $image;
  }
}