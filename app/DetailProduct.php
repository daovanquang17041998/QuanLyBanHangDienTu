<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailProduct extends Model
{
    protected $table = "detail_product";

    public function detai_bill_import()
    {
        return $this->hasMany("App\DetailBillImport","id_detail_product","id");
    }
    public function detai_bill_export()
    {
        return $this->hasMany("App\DetailBillExport","id_detail_product","id");
    }
    public function product()
    {
        return $this->belongsTo("App\Product","id_product","id");
    }
    public function screem()
    {
        return $this->belongsTo("App\Screem","id_screem","id");
    }
    public function color()
    {
        return $this->belongsTo("App\Color","id_color","id");
    }
    public function memory()
    {
        return $this->belongsTo("App\Memory","id_memory","id");
    }
}
