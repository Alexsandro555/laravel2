<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tnved extends Model
{
    use SoftDeletes;

    protected $table = 'tnved';

    protected $dates = ['deleted_at'];

    public function type_products()
    {
        return $this->hasMany('App\TypeProduct');
    }

}