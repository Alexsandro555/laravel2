<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Attributable extends Model
{
    protected $table = 'attribute_type_product';


    protected $fillable = [
        'type_product_id',
        'attribute_id',
    ];
}