<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = "color";
    public function detail_product()
    {
        return $this->hasMany('App\DetailProduct','id_color','id');
    }
}
