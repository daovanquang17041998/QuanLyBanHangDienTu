<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screem extends Model
{
    protected $table = "screem";
    public function detail_product()
    {
        return $this->hasMany('App\DetailProduct','id_screem','id');
    }
}
