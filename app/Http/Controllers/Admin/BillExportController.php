<?php

namespace App\Http\Controllers\Admin;

use App\BillExport;
use App\DetailBillExport;
use App\DetailBillImport;
use App\DetailProduct;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DetailBill;
class BillExportController extends Controller
{
    public function getAddBillExport()
    {
        $users = User::all();
        return view('admin.billexport.add_bill_export',compact('users'));
    }

    public function postAddBillExport(Request $request)
    {
        $this->validate($request,[
            "txtTotalMoney" => "required",
            "txtAddress" => "required",
            "txtPhone" => "required",
            "txtNote" => "required",
        ], [
            "txtTotalMoney.required" => "Bạn phải nhập tổng tiền",
            "txtAddress.required" => "Bạn phải nhập địa chỉ",
            "txtPhone.required" => "Bạn phải nhập số điện thoại",
            "txtNote.required" => "Bạn phải nhập ghi chú",
        ]);

        $bill_export= new BillExport();
        $bill_export->id_user = $request->selectUserId;
        $bill_export->totalmoney = $request->txtTotalMoney;
        $bill_export->payment = $request->txtPayment;
        $bill_export->status = $request->rdoNew;
        $bill_export->address = $request->txtAddress;
        $bill_export->phone = $request->txtPhone;
        $bill_export->note = $request->txtNote;
        $bill_export->save();
        return redirect("admin/don-hang/them")->with("message","Thêm hóa đơn bán thành công");

    }
   	public function getListBillExport()
   	{
   		$bills = BillExport::all();
   		return view('admin.billexport.list_bill_export',compact('bills'));
   	}
    public function getEditBillExport($id)
    {
        $users = User::all();
        $bill_export = BillExport::find($id);
        return view('admin.billexport.edit_bill_export',compact('bill_export','users'));
    }

    public function postEditBillExport(Request $request, $id){
        $this->validate($request,[
            "txtTotalMoney" => "required",
            "txtAddress" => "required",
            "txtPhone" => "required",
            "txtNote" => "required",
        ], [
            "txtTotalMoney.required" => "Bạn phải nhập tổng tiền",
            "txtAddress.required" => "Bạn phải nhập địa chỉ",
            "txtPhone.required" => "Bạn phải nhập số điện thoại",
            "txtNote.required" => "Bạn phải nhập ghi chú",
        ]);

        if(isset($_POST['ok']))
        {
            $bill_export = BillExport::find($id);
            $bill_export->id_user     = $request->selectUserId;
            $bill_export->totalmoney     = $request->txtTotalMoney;
            $bill_export->payment         = $request->txtPayment;
            $bill_export->status = $request->rdoNew;
            $bill_export->address = $request->txtAddress;
            $bill_export->phone = $request->txtPhone;
            $bill_export->note = $request->txtNote;
            $bill_export->save();
            return redirect("admin/don-hang/sua/".$id)->with('message','Sửa thành công');
        }
    }
    public function getDelBillExport($id)
    {
        $bill_export = BillExport::find($id);
        $bill_export->delete();
        return redirect('admin/don-hang/danh-sach')->with('message','xóa đơn hàng thành công');
    }
    public function getAddDetailBillExport($id)
    {
        $detail_product = DetailProduct::all();
        $bill_export =  BillExport::all();
        return view('admin.billexport.add_detail_bill_export',compact('detail_product','bill_export'));
    }

    public function postAddDetailBillExport(Request $request,$id)
    {
        $this->validate($request,[
            "txtPrice" => "required",
            "txtQuanlity" => "required",
        ], [
            "txtPrice.required" => "Bạn phải nhập giá",
            "txtQuanlity.required" => "Bạn phải nhập số lượng",
        ]);

        $detail_export = new DetailBillExport();
        $detail_export->id_detail_product = $request->selectDetailProductId;
        $detail_export->id_bill_export = $id;
        $detail_export->price = $request->txtPrice;
        $detail_export->quanlity = $request->txtQuanlity;
        $detail_export->save();
        return redirect("admin/don-hang/danh-sach")->with("message","Thêm chi tiết hóa đơn bán thành công");

    }
   	public function getListDetailBillExport($id)
   	{
   	    $product_items = DetailBillExport::where('id_bill_export',$id)->get();
        $detail_product_items = DetailBillExport::where('id_detail_product',$id)->get();
        $bill = BillExport::find($id);
        $customer = User::find($bill->id_user);
   		return view('admin.billexport.list_detail_bill_export',compact('bill','product_items','customer','detail_product_items'));
   	}
    public function getEditDetailBillExport($id)
    {
        $bill_detail = DetailBillExport::find($id) ;
        $detail_product = DetailProduct::all();
        $bill_export =  BillExport::all();
        return view('admin.billexport.edit_detail_bill_export',compact('bill_detail','detail_product','bill_export'));
    }

    public function postEditDetailBillExport(Request $request, $id){
        $this->validate($request,[
            "txtPrice" => "required",
            "txtQuanlity" => "required",
        ], [
            "txtPrice.required" => "Bạn phải nhập giá",
            "txtQuanlity.required" => "Bạn phải nhập số lượng",
        ]);

        $detail_export = DetailBillExport::find($id);
        $detail_export->id_detail_product = $request->selectDetailBillExportId;
        $detail_export->price = $request->txtPrice;
        $detail_export->quanlity = $request->txtQuanlity;
        $detail_export->save();
        return redirect("admin/don-hang/danh-sach")->with("message","Sửa chi tiết đơn hàng thành công");
    }
      public function getDelDetailBillExport($id)
      {
         $bill_export = DetailBillExport::find($id);
         $bill_export->delete();
         return redirect('admin/don-hang/danh-sach');
      }
}
