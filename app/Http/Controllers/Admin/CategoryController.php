<?php

namespace App\Http\Controllers\Admin;
use App\BillExport;
use App\Http\Controllers\Controller;
use App\Product;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use App\Category;
use DateTime;
class CategoryController extends Controller
{
    public function getIndexAdmin(){
        $user = User::all();
        $product = Product::all();
        $supplier = Supplier::all();
        $billexport = BillExport::all();
        return view('admin.index',compact('user','product','supplier','billexport'));
    }

    public function getAddCate()
    {
    	return view('admin.category.add_cate');
    }

    public function postAddCate(Request $request)
    {
    	$request->validate([
    		"txtCateName" => "required",
    	],[
    		"txtCateName.required" => "Bạn chưa nhập category name",
    	]);
        $cate             = new Category;
        $cate->name       = $request->txtCateName;
        $cate->created_at = new DateTime;
    	$cate->save();

    	return redirect(route('themdanhmuc'))->with("message","Thêm thành công");
    }

    public function getListCate()
    {
        $cates = Category::all();
        
        return view("admin.category.list_cate",compact('cates'));
    }

    public function getEditCate($id)
    {
        $cate = Category::all()->toArray();
        
        $item = Category::find($id);
   
        return view("admin.category.edit_cate",compact('cate','item'));
    }

    public function postEditCate($id ,Request $request)
    {
        $request->validate([
            "txtCateName" => "required",
        ],[
            "txtCateName.required" => "Bạn chưa nhập category name",
        ]);

        $cate             = Category::find($id);
        $cate->name       = $request->txtCateName;
        $cate->updated_at = new DateTime;
        $cate->save();
        return redirect('admin/danh-muc/sua/'.$id)->with("message","Sửa thành công");
    }

    public function getDelCate($id)
    {
            $cate = Category::find($id);
            $cate->delete();
            return redirect(route('listdanhmuc'))->with('message','xóa thành công');
    }
}
