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
    		"txtSupplierName" => "required|unique:Supplier,name",
    	],[
    		"txtSupplierName.required" => "Bạn chưa nhập tên nhà cung cấp",
    		"txtSupplierName.unique" => "Nhà Cung cấp đã tồn tại",
    	]);

    	$supplier = new Supplier();
        $supplier->name = $request->txtSupplierName;
        $supplier->address = $request->txtSupplierPhone;
        $supplier->phone = $request->txtSupplierPhone;
        $supplier->save();
    	return  redirect('admin/nha-cung-cap/danh-sach')->with('message',"Thêm thành công");
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
    		"txtSupplierName" => "required|unique:supplier,name,".$id,
    	],[
    		"txtSupplierName.required" => "Bạn chưa nhập tên nhà cung cấp",
    		"txtSupplierName.unique" => "Nhà cung cấp đã tồn tại",
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
