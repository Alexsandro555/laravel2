<?php
/**
 * Created by PhpStorm.
 * User: alexsandro
 * Date: 02.11.17
 * Time: 9:19
 */

namespace App\Services;

use App\FileHandler;
use App\TypeFile;
use Validator;

class FileUploadService
{
  private $file;
  private $id;
  private $tbl;
  private $typeFileNames;
  private $request;
  public $validator;

  public function __construct($file, $id, $tbl, $request) {
    $this->file = $file;
    $this->id = $id;
    $this->tbl = $tbl;
    $this->request = $request;
    $this->typeFileNames = $request->typefile;
    $this->fileHandler = new FileHandler();
  }

  public function maxsize($maxsize) {
    $messages = [
      'max' => 'Файл превышает максимальный размер',
    ];
    $rule = 'required|file|max:'.$maxsize;
    $validator = Validator::make($this->request->all(), [
      'file' => $rule
    ],$messages);
    if ($validator->fails()) {
      $this->validator = $validator;
      return false;
    }
    else {
      return true;
    }
  }

  public function maxsizeWYSIWYG($maxsize) {
    $messages = [
      'max' => 'Файл превышает максимальный размер',
    ];
    $rule = 'required|file|max:'.$maxsize;
    $validator = Validator::make($this->request->all(), [
      'upload' => $rule
    ],$messages);
    if ($validator->fails()) {
      $this->validator = $validator;
      return false;
    }
    else {
      return true;
    }
  }

  public function uploadFromWYSIWYG() {
    $typeFiles = TypeFile::where('name','file')->first();
    $conf = $typeFiles->config;
    if(isset($conf['maxsize'])) {
      $result = $this->maxsizeWYSIWYG($conf['maxsize']);
      if(!$result) {
        return false;
      }
    }
    return $this->fileHandler->upload($this->file, false, $this->tbl,$this->id, $typeFiles->id);
  }

  public function upload() {
    /*$currentFile = File::where('fileable_id',$this->id)->where('fileable_type',$this->tbl)->first();
    if($currentFile)
    {
      $currentFile->delete();
    }*/
    $typeFiles = TypeFile::where('name','file')->first();
    $conf = $typeFiles->config;
    if(isset($conf['maxsize'])) {
      $result = $this->maxsize($conf['maxsize']);
      if(!$result) {
        return redirect()->route('update-article',['id' => $this->id])
          ->withErrors($this->validator)->withInput();
      }
    }
    return $this->fileHandler->upload($this->file, false, $this->tbl,$this->id, $typeFiles->id);
  }

  public function resize() {
    // Удаляю текущие файлы
    /*$currentFiles = File::where('fileable_id',$this->id)->where('fileable_type',$this->tbl)->get();
    foreach ($currentFiles as $currentFile) {
      $currentFile->delete();
    }*/
    foreach ($this->typeFileNames as $typeFileName) {
      $typeFiles = TypeFile::where('name',$typeFileName)->get();
      foreach ($typeFiles as $typeFile) {
        $conf = $typeFile->config;
        // Проверка максимального размера
        if(isset($conf['maxsize'])) {
          $t = $conf['maxsize'];
          $this->maxsize($conf['maxsize']);
        }
        // Проверка соответсвия типов изображений
        if(isset($conf['ext'])) {
          $rule = 'mimes:'.$conf['ext'];
          $messages = [
            'mimes' => 'Изображения должны иметь следующие расширения: '+$conf['ext'],
          ];
          $validator = Validator::make($this->request->all(), [
            'file' => $rule
          ],$messages);
          if ($validator->fails()) {
            $this->validator = $validator;
            return false;
          }
        }
        // Заверщение проверки расширений
        if($conf['resize']) {
          $file = $this->fileHandler->upload($this->file, true, $this->tbl,$this->id, $typeFile->id, $conf['width'], $conf['height']);
        }
        else {
          $file = $this->fileHandler->upload($this->file, false, $this->tbl,$this->id, $typeFile->id);
        }
      }
    }
    return $file;
  }

}