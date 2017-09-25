<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
  use SoftDeletes;

  protected $dates = ['deleted_at'];

  protected $fillable = [
      'id',
      'title',
      'url_key',
      'price',
      'description',
      'qty',
      'active',
      'sort',
      'onsale',
      'special',
      'need_order',
      'category_id',
      'type_product_id',
      'producer_type_product_id',
      'producer_id',
      'article',
      'IEC'
  ];

  public function photo() {
      return $this->hasMany(ProductPhoto::class, 'product_id','id');
  }

  public function type_product() {
      return $this->belongsTo('App\TypeProduct');
  }

  public function category() {
      return $this->belongsTo('App\Category');
  }

  public function attributes() {
      return $this->belongsToMany('App\Attribute')->withPivot('value');
  }

  /**
   * Получить все изображения продукта
   */
  public function files() {
      return $this->morphMany('App\File', 'fileable');
  }

  public function producer_type_product() {
      return $this->belongsTo('App\ProducerTypeProduct');
  }

  public function setTitleAttribute($value)
  {
    $this->attributes['title'] = strip_tags($value);
  }

  /*public function setPriceAttribute($value)
  {
    $this->attributes['price'] = strip_tags($value);
  }*/

  public function setArticleAttribute($value)
  {
    $this->attributes['article'] = strip_tags($value);
  }

  public function setIECAttribute($value)
  {
    $this->attributes['IEC'] = strip_tags($value);
  }
}
