<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'code', 
        'name',
        'category_id',
        'description',
        'quantity',
        'price',
    ];

    public function category ()
    {
        return $this->belongsTo('App\Model\Category');
    }
}
