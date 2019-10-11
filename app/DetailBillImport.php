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
    public function detail_product()
    {
        return $this->belongsTo("App\DetailProduct","id_detail_product","id");
    }
}
