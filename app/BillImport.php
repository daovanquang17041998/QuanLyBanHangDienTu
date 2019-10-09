<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillImport extends Model
{
    protected $table = "bill_import";
    public function detail_bill_import()
    {
        return $this->hasMany("App\DetailBillImport","id_bill_import","id");
    }
    public function user()
    {
        return $this->belongsTo("App\User","id_user","id");
    }
}
