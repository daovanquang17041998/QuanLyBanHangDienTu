<?php

namespace App\Http\Controllers\Admin;

use App\BillImport;
use App\DetailBillImport;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillImportController extends Controller
{
   	public function getListBillImport()
   	{
   		$bills = BillImport::all();

   		return view('admin.billimport.list_bill_import',compact('bills'));
   	}
   	public function getDetailBillImport($id)
   	{
   	    $product_items = DetailBillImport::where('id_bill_import',$id)->get();
        $bill = BillImport::find($id);
        $customer = User::find($bill->id_user);
   		return view('admin.billimport.detail_bill_import',compact('bill','product_items','customer','detail_product_items'));
   	}

      public function getDelBillImport($id)
      {
         $bill = BillImport::find($id);
         $bill->delete();
         return redirect('admin/nhap-hang/danh-sach');
      }

      public function getDelDetailBillImport($id)
      {
         $bill = DetailBillImport::find($id);
         $bill->delete();
         return redirect('admin/nhap-hang/danh-sach');
      }
}
