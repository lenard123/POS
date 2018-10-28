<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    
    protected $fillable = ['name'];

    public function products ()
    {
        return $this->hasMany('App\Model\Product');
    }
}
