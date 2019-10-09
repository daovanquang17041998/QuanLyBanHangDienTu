<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailBillImport extends Model
{
    protected $table = "detail_bill_import";

    public function bill_import()
    {
        return $this->belongsTo("App\BillImport","id_bill_import","id");
    }
    public function bill_product()
    {
        return $this->belongsTo("App\BillProduct","id_bill_product","id");
    }
}
