<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AttributeProducerTypeProduct extends Model
{
  protected $table = 'attribute_producer_type_product';

  protected $fillable = [
    'producer_type_product_id',
    'attribute_id',
  ];
}