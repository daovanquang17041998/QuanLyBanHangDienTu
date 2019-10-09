<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
    protected $table = "memory";
    public function detail_product()
    {
        return $this->hasMany('App\DetailProduct','id_memory','id');
    }
}
