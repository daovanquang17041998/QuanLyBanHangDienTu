<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = "supplier";

    public function bill_import()
    {
        return $this->hasMany('App\BillImport','id_supplier','id');
    }
}
