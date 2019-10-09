<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailBillExport extends Model
{
    protected $table = "detail_bill_export";

    public function bill_export()
    {
        return $this->belongsTo("App\BillExport","id_bill_export","id");
    }
    public function detail_product()
    {
        return $this->belongsTo("App\DetailProduct","id_detail_product","id");
    }
}
