<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeProduct extends Model
{
  use SoftDeletes;

  protected $fillable = [
      'id',
      'title',
      'sort',
      'tnved_id',
      'description'

  ];

  protected $dates = ['deleted_at'];

  public function products() {
    return $this->hasMany('App\Product');
  }

  public function tnveds() {
    return $this->belongsTo('App\Tnved');
  }

  public function producer_type_products() {
    return $this->hasMany('App\ProducerTypeProduct');
  }

  public function producers() {
    return $this->belongsToMany('App\Producer')->withPivot('id','name_line','sort');
  }

  public function files() {
    return $this->morphMany('App\File', 'fileable');
  }

  public function attributes() {
    return $this->morphToMany('App\Attribute', 'attributable');
  }
}