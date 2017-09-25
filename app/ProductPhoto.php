<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    protected $table = 'product_photo';

    protected $fillable = [
            'product_id',
            'filename',
            'size'
        ];
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
