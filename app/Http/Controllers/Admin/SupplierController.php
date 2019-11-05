<?php

namespace App\Http\Controllers\Admin;

use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    public function getAddSupplier()
    {
    	return view('admin.supplier.add_supplier');
    }
    public function postAddSupplier(Request $request)
    {
    	$this->validate($request,[
    		"txtSupplierName" => "required|max:250|unique:Supplier,name",
            "txtSupplierAddress" => "required|max:250",
            "txtSupplierPhone" => "required|numeric",
    	],[
    		"txtSupplierName.required" => "Bạn chưa nhập tên nhà cung cấp",
    		"txtSupplierName.unique" => "Tên nhà Cung cấp đã tồn tại",
            "txtSupplierName.max" => "Tên nhà cung cấp không quá 250 kí tự",
            "txtSupplierAddress.required" => "Bạn chưa nhập địa chỉ",
            "txtSupplierAddress.max" => "Địa chỉ nhà cung cấp không quá 250 kí tự",
            "txtSupplierPhone.required" => "Bạn chưa nhập số điện thoại",
            "txtSupplierPhone.numeric" => "Số điện thoại phải là số",
    	]);

    	$supplier = new Supplier();
        $supplier->name = $request->txtSupplierName;
        $supplier->address = $request->txtSupplierPhone;
        $supplier->phone = $request->txtSupplierPhone;
        $supplier->save();
    	return  redirect('admin/nha-cung-cap/them')->with('message',"Thêm thành công");
    }

    public function getListSupplier()
    {
    	$suppliers = Supplier::all();
    	return view('admin.supplier.list_supplier',compact('suppliers'));
    }
    public function geteditSupplier($id)
    {
        $supplier = Supplier::all()->toArray();
        $item = Supplier::find($id);
    	return view('admin.supplier.edit_supplier',compact('supplier','item'));
    }
    public function postEditSupplier($id, Request $request)
    {
        $this->validate($request,[
            "txtSupplierName" => "required|max:250",
            "txtSupplierAddress" => "required|max:250",
            "txtSupplierPhone" => "required|numeric",
        ],[
            "txtSupplierName.required" => "Bạn chưa nhập tên nhà cung cấp",
            "txtSupplierName.max" => "Tên nhà cung cấp không quá 250 kí tự",
            "txtSupplierAddress.required" => "Bạn chưa nhập địa chỉ",
            "txtSupplierAddress.max" => "Địa chỉ nhà cung cấp không quá 250 kí tự",
            "txtSupplierPhone.required" => "Bạn chưa nhập số điện thoại",
            "txtSupplierPhone.numeric" => "Số điện thoại phải là số",
        ]);

    	$supplier = Supplier::find($id);
        $supplier->name = $request->txtSupplierName;
        $supplier->address = $request->txtSupplierAddress;
        $supplier->phone= $request->txtSupplierPhone;
        $supplier->save();
    	return redirect("admin/nha-cung-cap/sua/".$id)->with('message','Sửa thành công');
    }
    public function getDelSupplier($id)
   {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect('admin/nha-cung-cap/danh-sach')->with('message','Xóa thành công');
   }
}
