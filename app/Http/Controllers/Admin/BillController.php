<?php

namespace App\Http\Controllers\Admin;

use App\BillExport;
use App\DetailBillExport;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DetailBill;
class BillController extends Controller
{
   	public function getListBill()
   	{
   		$bills = BillExport::all();

   		return view('admin.bill.list_bill',compact('bills'));
   	}
   	public function getDetailBill($id)
   	{
   	    $product_items = DetailBillExport::where('id_bill_export',$id)->get();
        $detail_product_items = DetailBillExport::where('id_detail_product',$id)->get();
        $bill = BillExport::find($id);
        $customer = User::find($bill->id_user);
   		return view('admin.bill.detail_bill',compact('bill','product_items','customer','detail_product_items'));
   	}

      public function getDelBill($id)
      {
         $bill = BillExport::find($id);
         $bill->delete();
         return redirect('admin/don-hang/danh-sach');
      }

      public function getDelDetailBill($id)
      {
         $bill = DetailBillExport::find($id);
         $bill->delete();
         return redirect('admin/don-hang/danh-sach');
      }
}
