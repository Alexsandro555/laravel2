<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'title',
        'sort',
    ];

    protected $dates = ['deleted_at'];

    public function type_products()
    {
        return $this->belongsToMany('App\TypeProduct');
    }

}

