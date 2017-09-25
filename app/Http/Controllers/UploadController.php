<?php
namespace App\Http\Controllers;

use App\Http\Requests\Product\UploadProductRequest;
use App\ProductPhoto;
use Intervention\Image\ImageManager;
use App\File;

class UploadController extends Controller
{
    private $path = "app/public/";

    private $pathIcon = "app/public/icons/";

    public function uploadHandl(UploadProductRequest $request)
    {
        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) -1);
        $filename = $this->sanitize($originalNameWithoutExt);
        $allowed_filename = $this->createUniqueFilename( $filename, $extension );
        $uploadSuccess = $this->move( $file, $allowed_filename );
        if(!$uploadSuccess)
        {
            return response()->json([
                                    'error' => true,
                                    'code' => 500
                               ],500);
        }

        /*$uploadiconSuccess = $this->icons( $file, $allowed_filename );
        if(!$uploadiconSuccess) {
            return response()->json([
                'error' => true,
                'code' => 500
            ],500);
        }*/

        $size = $this->size($file);
        $file = File::create([
            'filename' => $allowed_filename,
            'size' => $size
        ]);
        return response()->json(['error'=> false, 'id'=> $file->id, 'code' => 200], 200);
    }

    function sanitize($string, $force_lowercase = true, $anal = false)
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

    public function createUniqueFilename( $filename, $extension )
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

    public function size( $photo )
    {
        $manager = new ImageManager();
        $image = $manager->make( $photo );
        $size = $image->filesize();
        return $size;
    }

    public function move( $photo, $filename )
    {
        $manager = new ImageManager();
        $path = storage_path($this->pathIcon).$filename;
        $image = $manager->make( $photo )->save(storage_path($this->path) . $filename );
        return $image;
    }

    public function icons( $photo, $filename )
    {
        $manager = new ImageManager();
        $path = storage_path($this->pathIcon).$filename;
        $image = $manager->make( $photo )->resize(200,200)->save(storage_path($this->pathIcon) . $filename );
        return $image;
    }


    /**
     *  Get Files
     * @param int $id
     * @return \Illuminate\Http\Response:json
     */
    public function getFiles($id)
    {
        $id = (int)$id;
        $image = File::where('fileable_id',$id)->get();
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
        $file = File::find($id);
        $file->delete();
        return response()->json([],200);
    }
}