<?php
/**
 * Created by PhpStorm.
 * User: alexsandro
 * Date: 24.10.17
 * Time: 11:20
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeFile extends Model
{
  use SoftDeletes;

  protected $dates = ['deleted_at'];

  protected $fillable = [
    'id',
    'name',
    'config'
  ];

  protected $casts = [
    'config' => 'array',
  ];

  public function files() {
    return $this->hasMany('App\File');
    //return $this->hasMany(File::class, 'type_file_id','id');
  }
}