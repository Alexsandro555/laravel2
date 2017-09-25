<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProducerTypeProduct extends Model
{
    protected $table = 'producer_type_product';

    use SoftDeletes;

    protected $fillable = [
        'id',
        'name_line',
        'sort',
        'producer_id',
        'type_product_id'
    ];

    protected $guarded = [];

    public function type_products() {
        return $this->belongsTo('App\TypeProduct');
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

  public function files() {
    return $this->morphMany('App\File', 'fileable');
  }

  public function attributes() {
    return $this->belongsToMany('App\Attribute')->withPivot('producer_type_product_id','attribute_id');
  }
}