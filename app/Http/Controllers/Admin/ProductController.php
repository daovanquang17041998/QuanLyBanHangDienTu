<?php
namespace App\Http\Controllers\Admin;

use App\DetailProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;

use App\Category;
use App\Product;
use File;
class ProductController extends Controller
{
    public function getAddProduct()
    {
    	$cates = Category::all();
    	return view('admin.product.add_product',compact('cates'));
    }

    public function postAddProduct(Request $request)
    {
        $this->validate($request, [
            "txtName" => "unique:products,name",
        ], [
            "txtName.unique" => "Tên sản phẩm bị trùng",
        ]);
        $product = new Product;
        $product->id_category = $request->selectCategoryId;
        $product->name = $request->txtName;
        $product->description = $request->txtDescription;
        $product->unit_price = $request->txtUnitPrice;
        $product->promotion_price = $request->txtPromoPrice;
        $product->status = $request->rdoNew;
        $product->image = $request->file('txtAvatar');
        $get_image = $request->file('txtAvatar');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $get_image->move('uploads/product',$get_name_image);
            $product->image = $get_name_image;
            $product->save();
            return redirect("admin/san-pham/them")->with("message","Thêm sản phẩm thành công");
        }
        else
            $product->image ="";
            $product->save();
        return redirect("admin/san-pham/them")->with("message","Thêm sản phẩm thành công");

    }
    public function getListProduct()
    {
        $products = Product::orderBy('id','DESC')->get();
      
        return view('admin.product.list_product',compact('products'));
    }

    public function getEditProduct($id)
    {
        $cates = Category::all();
        $product = Product::find($id);
        return view('admin.product.edit_product',compact('product','cates'));
    }

    public function postEditProduct(Request $request, $id){
        if(isset($_POST['ok']))
        {
            $this->validate($request,[
            "txtName" => "unique:products,name,".$id,
        ],[
            "txtName.unique" => "Tên sản phẩm bị trùng",
        ]);

        $product = Product::find($id);
        $product->id_category     = $request->selectCategoryId;
        $product->name            = $request->txtName;
        $product->description     = $request->txtDescription;
        $product->unit_price      = $request->txtUnitPrice;
        $product->promotion_price = $request->txtPromoPrice; 
        $product->status          = $request->rdoNew;
        $get_image = $request->file('txtAvatar');
        if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $get_image->move('uploads/product',$get_name_image);
                $product->image = $get_name_image;
                $product->save();
        return redirect("admin/san-pham/sua/".$id)->with('message','Sửa thành công');
        }
        else
        $product->image ="";
        $product->save();
        return redirect("admin/san-pham/sua/".$id)->with('message','Sửa thành công');
        } 
    }
    public function getDelProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect(route('listsanpham'))->with('message','xóa thành công');
    }

    public function getDetailProduct($id)
    {
        $product_items = DetailProduct::where('id_product',$id)->get();
        $detail_product_items = DetailProduct::where('id_detail_product',$id)->get();
        $bill = DetailProduct::find($id);
        $customer = User::find($bill->id_user);
        return view('admin.product.detail_product',compact('bill','product_items','customer','detail_product_items'));
    }
    public function getDelDetailProduct($id)
    {
        $bill = DetailProduct::find($id);
        $bill->delete();
        return redirect('admin/san-pham/danh-sach');
    }
}
