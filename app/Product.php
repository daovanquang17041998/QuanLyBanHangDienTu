<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    public function detai_product()
    {
        return $this->hasMany('App\DetailProduct','id_product','id');
    }
    public function feed_back()
    {
        return $this->hasMany('App\FeedBack','id_product','id');
    }
    public function category()
    {
        return $this->belongsTo('App\Category','id_category','id');
    }
}
