<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
  use SoftDeletes;

  protected $dates = ['deleted_at'];

  protected $fillable = [
    'id',
    'title',
    'url_key',
    'content'
  ];

  public function files() {
    return $this->morphMany('App\File', 'fileable');
  }
}
