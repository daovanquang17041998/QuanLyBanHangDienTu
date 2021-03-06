<?php
namespace App\Http\Controllers\Admin;

use App\Color;
use App\DetailBillExport;
use App\DetailBillImport;
use App\DetailProduct;
use App\Memory;
use App\Screem;
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
        //lấy ra tất các loại sản phẩm
    	$cates = Category::all();
    	return view('admin.product.add_product',compact('cates'));
    }

    public function postAddProduct(Request $request)
    {
        $this->validate($request, [
            "txtName" => "required|max:15|unique:products,name",
            "txtDescription" => "max:250",
        ], [
            "txtName.unique" => "Tên sản phẩm bị trùng",
            "txtName.max" => "Tên có độ dài không quá 15 kí tự",
            "txtName.required" => "Bạn phải nhập tên sản phẩm",
            "txtDescription.max" => "Mô tả có độ dài không quá 250 kí tự",
        ]);
        $product = new Product;
        $product->id_category = $request->selectCategoryId;
        $product->name = $request->txtName;
        $product->description = $request->txtDescription;
        $product->status = $request->rdoNew;
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
        $this->validate($request, [
            "txtName" => "required|max:15",
            "txtDescription" => "required|max:250",
        ], [
            "txtName.max" => "Tên có độ dài không quá 15 kí tự",
            "txtName.required" => "Bạn phải nhập tên sản phẩm",
            "txtDescription.required" => "Bạn phải nhập mô tả",
            "txtDescription.max" => "Mô tả có độ dài không quá 250 kí tự",
        ]);
        if(isset($_POST['ok']))
        {
        $product = Product::find($id);
        $product->id_category     = $request->selectCategoryId;
        $product->name            = $request->txtName;
        $product->description     = $request->txtDescription;
        $product->status          = $request->rdoNew;
        $product->save();
        return redirect("admin/san-pham/sua/".$id)->with('message','Sửa thành công');
        } 
    }
    public function getDelProduct($id)
    {
        $detail_product = DetailProduct::all();
        foreach ($detail_product as $detail_products):
            if ($detail_products->id_product==$id){
                return redirect(route('listsanpham'))->with('error','Không xóa được sản phẩm này');
            }
        endforeach;
        $product = Product::find($id);
        $product->delete();
        return redirect(route('listsanpham'))->with('message','xóa thành công');
    }
    public function getAddDetailProduct($id)
    {
        $product = Product::find($id);
        $color = Color::all();
        $memory= Memory::all();
        $screem = Screem::all();
        return view('admin.product.add_detail_product',compact('product','color','memory','screem'));
    }

    public function postAddDetailProduct(Request $request,$id)
    {
        $this->validate($request,[
            "txtUnitprice" => "required|numeric",
            "txtPromotionprice" => "required|numeric",
            "txtQuanlity" => "required|numeric",
        ], [
            "txtUnitprice.required" => "Bạn phải nhập đơn giá",
            "txtUnitprice.numeric" => "Đơn giá phải là số",
            "txtPromotionprice.required" => "Bạn phải nhập giá khuyến mãi",
            "txtPromotionprice.numeric" => "Giá khuyến mãi phải là số",
            "txtQuanlity.required" => "Bạn phải nhập số lượng",
            "txtQuanlity.numeric" => "Số lượng phải là số",
        ]);

        $product = new DetailProduct();
        $product->id_product = $id;
        $product->id_color = $request->selectColorId;
        $product->id_memory = $request->selectMemoryId;
        $product->id_screem = $request->selectScreemId;
        $product->unit_price = $request->txtUnitprice;
        $product->promotion_price = $request->txtPromotionprice;
        $product->quanlity = $request->txtQuanlity;
        $product->image = $request->file('txtAvatar');
        $get_image = $request->file('txtAvatar');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $get_image->move('uploads/product',$get_name_image);
            $product->image = $get_name_image;
            $product->save();
            return redirect("admin/san-pham/chi-tiet/them/".$id)->with("message","Thêm chi tiết sản phẩm thành công");
        }
        else
            $product->image ="";
        $product->save();
        return redirect("admin/san-pham/chi-tiet/".$id)->with("message","Thêm chi tiết sản phẩm thành công");

    }
    public function getListDetailProduct($id)
    {
        $product_items = DetailProduct::where('id_product',$id)->get();
        return view('admin.product.list_detail_product',compact('product_items'));
    }
    public function getEditDetailProduct($id)
    {
        $product_detail = DetailProduct::find($id) ;
        $product_items = DetailProduct::where('id_product',$id)->get();
        $product = Product::all();
        $color = Color::all();
        $memory= Memory::all();
        $screem = Screem::all();
        return view('admin.product.edit_detail_product',compact('product_detail','product','color','memory','screem','product_items'));
    }

    public function postEditDetailProduct(Request $request, $id){
        $this->validate($request,[
            "txtUnitprice" => "required|numeric",
            "txtPromotionprice" => "required|numeric",
            "txtQuanlity" => "required|numeric",
        ], [
            "txtUnitprice.required" => "Bạn phải nhập đơn giá",
            "txtUnitprice.numeric" => "Đơn giá phải là số",
            "txtPromotionprice.required" => "Bạn phải nhập giá khuyến mãi",
            "txtPromotionprice.numeric" => "Giá khuyến mãi phải là số",
            "txtQuanlity.required" => "Bạn phải nhập số lượng",
            "txtQuanlity.numeric" => "Số lượng phải là số",
        ]);
        $product = DetailProduct::find($id);
        $product->id_color = $request->selectColorId;
        $product->id_memory = $request->selectMemoryId;
        $product->id_screem = $request->selectScreemId;
        $product->unit_price = $request->txtUnitprice;
        $product->promotion_price = $request->txtPromotionprice;
        $product->quanlity = $request->txtQuanlity;
        $get_image = $request->file('txtAvatar');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $get_image->move('uploads/product',$get_name_image);
            $product->image = $get_name_image;
            $product->save();
            return redirect("admin/san-pham/chi-tiet/sua/".$id)->with("message","Sửa chi tiết sản phẩm thành công");
        }
        else
        $product->image = "".$product->image;
        $product->save();
        return redirect("admin/san-pham/chi-tiet/sua/".$id)->with("message","Sửa chi tiết sản phẩm thành công");
    }
    public function getDelDetailProduct($id)
    {
        $detail_bill_import = DetailBillImport::all();
        foreach ($detail_bill_import as $detail_bill_imports):
            if($detail_bill_imports->id_detail_product==$id){
                return redirect("admin/san-pham/danh-sach")->with('error','Không thể xóa chi tiết sản phẩm này');
            }
        endforeach;
        $detail_bill_export = DetailBillExport::all();
        foreach ($detail_bill_export as $detail_bill_exports):
            if($detail_bill_exports->id_detail_product==$id){
                return redirect("admin/san-pham/danh-sach")->with('error','Không thể xóa chi tiết sản phẩm này');
            }
        endforeach;
        $product = DetailProduct::find($id);
        $product->delete();
        return redirect("admin/san-pham/danh-sach")->with('message','xóa thành công');
    }
}
