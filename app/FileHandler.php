<?php
namespace App;


use Intervention\Image\ImageManager;
use App\File;


class FileHandler
{
    private $path = "app/public/";

    private $pathIcon = "app/public/icons/";

    public function upload($file, $resize, $model, $id, $width=0, $height=0)
    {
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) -1);
        $filename = $this->sanitize($originalNameWithoutExt);
        $allowed_filename = $this->createUniqueFilename( $filename, $extension );
        if($resize) {
            $uploadiconSuccess = $this->icons( $file, $allowed_filename, $width, $height, $this->path );
            if(!$uploadiconSuccess) {
                return false;
            }
        }
        else
        {
            $uploadSuccess = $this->move( $file, $allowed_filename );
            if(!$uploadSuccess)
            {
                return false;
            }
        }
        $size = $this->size($file);
        $file = File::create([
            'filename' => $allowed_filename,
            'size' => $size,
            'fileable_id' => $id,
            'fileable_type' => $model,
        ]);
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
        $manager = new ImageManager();
        $image = $manager->make( $photo )->save(storage_path($this->path) . $filename );
        return $image;
    }

    private function icons( $photo, $filename, $width, $height, $path )
    {
        $manager = new ImageManager();
        $image = $manager->make( $photo )->resize($width,$height)->save(storage_path($this->path) . $filename );
        return $image;
    }
}