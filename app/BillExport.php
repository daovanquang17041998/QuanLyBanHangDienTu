<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillExport extends Model
{
    protected $table = "bill_export";
    public function detail_bill_export()
    {
        return $this->hasMany("App\DetailBillExport","id_bill_export","id");
    }
    public function user()
    {
        return $this->belongsTo("App\User","id_user","id");
    }
}
