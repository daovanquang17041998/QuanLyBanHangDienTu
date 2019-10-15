<?php

namespace App\Http\Controllers\Admin;

use App\BillImport;
use App\DetailBillImport;
use App\DetailProduct;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillImportController extends Controller
{
    public function getAddBillImport()
    {
        $suppliers = Supplier::all();
        $users = User::all();
        return view('admin.billimport.add_bill_import',compact('suppliers','users'));
    }

    public function postAddBillImport(Request $request)
    {
        $bill_import= new BillImport();
        $bill_import->id_user = $request->selectUserId;
        $bill_import->id_supplier = $request->selectSuppplierId;
        $bill_import->totalmoney = $request->txtTotalMoney;
        $bill_import->payment = $request->txtPayment;
        $bill_import->save();
        return redirect("admin/nhap-hang/them")->with("message","Thêm hóa đơn nhập thành công");

    }
   	public function getListBillImport()
   	{
   		$bills = BillImport::orderBy('id','DESC')->get();
   		return view('admin.billimport.list_bill_import',compact('bills'));
   	}
    public function getEditBillImport($id)
    {
        $users = User::all();
        $suppliers = Supplier::all();
        $bill_import = BillImport::find($id);
        return view('admin.billimport.edit_bill_import',compact('bill_import','suppliers','users'));
    }

    public function postEditBillImport(Request $request, $id){
        if(isset($_POST['ok']))
        {
            $bill_import = BillImport::find($id);
            $bill_import->id_user     = $request->selectUserId;
            $bill_import->id_supplier            = $request->selectSupplierId;
            $bill_import->totalmoney     = $request->txtTotalMoney;
            $bill_import->payment         = $request->txtPayment;
            $bill_import->save();
            return redirect("admin/nhap-hang/sua/".$id)->with('message','Sửa thành công');
        }
    }
    public function getDelBillImport($id)
    {
        $bill_import = BillImport::find($id);
        $bill_import->delete();
        return redirect('admin/nhap-hang/danh-sach')->with('message','xóa thành công');
    }
    public function getAddDetailBillImport($id)
    {
        $detail_product = DetailProduct::all();
        $bill_import =  BillImport::all();
        return view('admin.billimport.add_detail_bill_import',compact('detail_product','bill_import'));
    }

    public function postAddDetailBillImport(Request $request,$id)
    {
        $detail_import = new DetailBillImport;
        $detail_import->id_bill_import=$id;
        $detail_import->id_detail_product = $request->selectDetailProductId;
        $detail_import->price = $request->txtPrice;
        $detail_import->quanlity = $request->txtQuanlity;
        $detail_import->save();
        return redirect("admin/nhap-hang/danh-sach")->with("message","Thêm chi tiết hóa đơn nhập thành công");

    }
    public function getListDetailBillImport($id)
    {
        $detail_product_items = DetailBillImport::where('id_bill_import',$id)->get();
        $bill_import = BillImport::find($id);
        $user = User::find($bill_import->id_user);
        $supplier = Supplier::find($bill_import->id_supplier);
        return view('admin.billimport.list_detail_bill_import',compact('bill_import','detail_product_items','user','supplier'));
    }
    public function getEditDetailBillImport($id)
    {
        $bill_detail = DetailBillImport::find($id) ;
        $detail_product = DetailProduct::all();
        $bill_import =  BillImport::all();
        return view('admin.billimport.edit_detail_bill_import',compact('bill_detail','detail_product','bill_import'));
    }

    public function postEditDetailBillImport(Request $request, $id){

        $detail_import = DetailBillImport::find($id);
        $detail_import->id_detail_product = $request->selectDetailBillImportId;
        $detail_import->price = $request->txtPrice;
        $detail_import->quanlity = $request->txtQuanlity;
        $detail_import->save();
        return redirect("admin/nhap-hang/danh-sach")->with("message","Sửa chi tiết nhập hàng thành công");
    }
    public function getDelDetailBillImport($id)
    {
        $product = DetailBillImport::find($id);
        $product->delete();
        return redirect('admin/nhap-hang/danh-sach')->with('message','xóa thành công');
    }
}
