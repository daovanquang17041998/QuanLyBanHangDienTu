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
use Illuminate\Support\Facades\DB;

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
            "txtAddress" => "required|max:250",
            "txtPhone" => "required|numeric",
            "txtNote" => "max:250",
        ], [
            "txtAddress.required" => "Bạn phải nhập địa chỉ",
            "txtAddress.max" => "Địa chỉ không quá 250 kí tự",
            "txtPhone.required" => "Bạn phải nhập số điện thoại",
            "txtPhone.numeric" => "Số điện thoại phải là số",
            "txtNote.max" => "Ghi chú không quá 250 kí tự",
        ]);

        $bill_export= new BillExport();
        $bill_export->id_user = $request->selectUserId;
        $bill_export->totalmoney = 0;
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
            "txtAddress" => "required|max:250",
            "txtPhone" => "required|numeric",
            "txtNote" => "max:250",
        ], [
            "txtAddress.required" => "Bạn phải nhập địa chỉ",
            "txtAddress.max" => "Địa chỉ không quá 250 kí tự",
            "txtPhone.required" => "Bạn phải nhập số điện thoại",
            "txtPhone.numeric" => "Số điện thoại phải là số",
            "txtNote.max" => "Ghi chú không quá 250 kí tự",
        ]);

        if(isset($_POST['ok']))
        {
            $bill_export = BillExport::find($id);
            $bill_export->id_user     = $request->selectUserId;
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
        $detail_bill_export = DetailBillExport::all();
        foreach ($detail_bill_export as $detail_bill_exports):
            if($detail_bill_exports->id_bill_export==$id){
                return redirect('admin/don-hang/danh-sach')->with('error','Bạn phải xóa chi tiết đơn hàng trước khi xóa đơn hàng này');
            }
        endforeach;
        $bill_export = BillExport::find($id);
        $bill_export->delete();
        return redirect('admin/don-hang/danh-sach')->with('message','xóa đơn hàng thành công');
    }
    public function getAddDetailBillExport($id)
    {
        $id_detail_export = BillExport::find($id);
        $detail_product = DetailProduct::all();
        $bill_export =  BillExport::all();
        return view('admin.billexport.add_detail_bill_export',compact('detail_product','bill_export','id_detail_export'));
    }

    public function postAddDetailBillExport(Request $request,$id)
    {
        $this->validate($request,[
            "txtQuanlity" => "required|numeric",
        ], [
            "txtQuanlity.required" => "Bạn phải nhập số lượng",
            "txtQuanlity.numeric" => "Số lượng phải là số",
        ]);

        $detail_export = new DetailBillExport();
        $detail_export->id_detail_product = $request->selectDetailProductId;
        $detail_export->id_bill_export = $id;
        $id_detail_product = DetailProduct::find( $request->selectDetailProductId);
        $detail_export->price = $id_detail_product->promotion_price;
        $detail_export->quanlity = $request->txtQuanlity;
        $detail_export->save();
        $price = BillExport::find($id);
        $sl = DetailProduct::find($request->selectDetailProductId);
        $gia = DB::table('bill_export')->where('id',$id)->update(['totalmoney'=> $price->totalmoney + $id_detail_product->promotion_price * $request->txtQuanlity]);
        $soluong = DB::table('detail_product')->where('id',$request->selectDetailProductId)->update(['quanlity'=> $sl->quanlity + $request->txtQuanlity]);
        return redirect("admin/don-hang/chi-tiet/them/".$id)->with("message","Thêm chi tiết hóa đơn bán thành công");

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
            "txtQuanlity" => "required|numeric",
        ], [
            "txtQuanlity.required" => "Bạn phải nhập số lượng",
            "txtQuanlity.numeric" => "Số lượng phải là số",
        ]);
        $detail_export = DetailBillExport::find($id);
        $cu =  $detail_export->quanlity;
        $gia_cu = $detail_export->price;
        $detail_export->id_detail_product = $request->selectDetailBillExportId;
        $id_detail_product = DetailProduct::find( $request->selectDetailBillExportId);
        $detail_export->price = $id_detail_product->promotion_price;
        $detail_export->quanlity = $request->txtQuanlity;
        $pro = $detail_export->detail_product->id;
        $bill = $detail_export->bill_export->id;
        $quan= DB::table('detail_product')->where('id',$pro)->update(['quanlity'=> $detail_export->detail_product->quanlity + $cu - $request->txtQuanlity]);
        $total = DB::table('bill_export')->where('id',$bill)->update(['totalmoney'=> $detail_export->bill_export->totalmoney - $gia_cu*$cu + $request->txtQuanlity*$id_detail_product->promotion_price]);
        $detail_export->save();
        return redirect("admin/don-hang/danh-sach")->with("message","Sửa chi tiết đơn hàng thành công");
    }
      public function getDelDetailBillExport($id)
      {
          $bill_export = DetailBillExport::find($id);
          $pro = $bill_export->detail_product->id;
          $bill = $bill_export->bill_export->id;
          $quan= DB::table('detail_product')->where('id',$pro)->update(['quanlity'=> $bill_export->detail_product->quanlity + $bill_export->quanlity]);
          $total = DB::table('bill_export')->where('id',$bill)->update(['totalmoney'=> $bill_export->bill_export->totalmoney - $bill_export->price*$bill_export->quanlity]);
          $bill_export->delete();
         return redirect('admin/don-hang/danh-sach');
      }
}
