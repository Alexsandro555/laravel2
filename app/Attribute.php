<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
  use SoftDeletes;

  protected $dates = ['deleted_at'];

  protected $fillable = [
    'sort',
    'title',
    'alias',
    'inshort'
  ];

  public function attributeTypeProducts() {
    return $this->hasMany('App\AttributeTypeProduct');
  }

  public function type_products() {
    return $this->belongsToMany('App\TypeProduct');
  }

  public function producer_type_products() {
    return $this->belongsToMany('App\ProducerTypeProduct');
  }

  public function products() {
      return $this->belongsToMany('App\Product')->withPivot('value');;
  }

  public function typeProducts() {
    return $this->morphedByMany('App\TypeProduct', 'attributable');
  }

  public function lineProducts() {
    return $this->morphedByMany('App\ProducerTypeProduct', 'attributable');
  }
}
