<?php

namespace App\Http\Controllers;

use App\BillExport;
use App\DetailBillExport;
use App\DetailProduct;
use App\User;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function getAddToCart(Request $request,$id){
       $detail =  DetailProduct::select('id','id_product','unit_price','promotion_price','quanlity','image')->find($id);
       if(!$detail) return redirect(route('trang-chu'));
       \Cart::add([
           'id'=>$id,
           'name'=> $detail->product->name,
           'quantity'=> 1,
           'price'=> $detail->promotion_price,
           'attributes' => array(
               'image'=> $detail->image
        )
       ]);
        $userId = auth()->user()->id;
        \Cart::session($userId)->add([
            'id'=>$id,
            'name'=> $detail->product->name,
            'quantity'=> 1,
            'price'=> $detail->promotion_price,
            'attributes' => array(
                'image'=> $detail->image
            )
        ]);
       return redirect()->back();
    }

    public function getDelItemCart($id){
         \Cart::remove($id);
        return redirect()->back();
    }
    public function getListCart(){
        $product_cart =   \Cart::getContent();
        return view('page.gio_hang',compact('product_cart'));
    }
    public function getCheckout(){
       $product_cart =   \Cart::getContent();
        return view('page.dat_hang',compact('product_cart'));
    }
    public function postCheckout(Request $request){
        //Kiêm tra xem số lượng mỗi sản phẩm có còn trong kho hàng nữa không
        $flag = true;
        $list_soil_out = "";
        foreach( \Cart::getContent() as $row)
        {
            $detail = DetailProduct::where('id',$row->id)->first();
            $quantity = $detail->quanlity;
            if($quantity == 0){
                $list_soil_out .= " ".$row->name." đã hết hàng.";
                $flag = false;
                \Cart::remove($row->id);
            }
            //nếu số lượng trong cart lớn hơn kho
            else if($row->quantity > $quantity)
            {
                $list_soil_out .= " ".$row->name. " còn ".$quantity." sản phẩm.";
                $flag = false;
                //update lại số lượng sản phẩm trong cart bằng số lượng trong kho.
                \Cart::update($row->id, array(
                    'quantity' => - $row->quantity+1,
                ));
            }
        }
        if(!$flag){
            return redirect('user/dat-hang')->with('loi',"Bạn vui lòng kiểm tra lại giỏ hàng: ".$list_soil_out);
        }
        else{
            $this->validate($request,[
                "phone" => "required|numeric",
                "address" => "required",
                "name" => "required",
            ], [
                "phone.required" => "Bạn phải nhập số điện thoại",
                "phone.numeric"    => "Số điện thoại phải là số",
                "address.required" => "Bạn phải nhập địa chỉ",
                "name.required" => "Bạn phải nhập họ tên",
            ]);
            //thêm thông tin người dùng vào hóa đơn và chi tiết hóa đơn
            $total =  \Cart::getSubTotal();
            $customer = new BillExport();
            $customer->id_user = get_data_user('web');
            $customer->totalmoney = $total;
            $customer->address = $request->address;
            $customer->phone = $request->phone;
            $customer->note = $request->note;
            $customer->status = 1;
            $customer->payment = $request->payment;
            $customer->save();

            $product_cart =   \Cart::getContent();
            foreach ($product_cart as $product){
                $detail = new DetailBillExport();
                $detail->id_bill_export = $customer->id;
                $detail->id_detail_product = $product->id;
                $detail->quanlity = $product->quantity;
                $detail->price =  $product->price;
                $detail->save();
                $detail_p = DetailProduct::where('id',$product->id)->first();
                $quantity = $detail_p->quanlity;
                $quantity_remain = $quantity - $product->quantity;
                //cập nhật lại số lượng hàng trong kho
                $quantity = DB::table('detail_product')->where('id',$product->id)->update(['quanlity'=>$quantity_remain]);
            }
            \Cart::clear();
            return redirect('user/dat-hang')->with('thanhcong',"Bạn đã đặt hàng thành công. Quay lại trang chủ để xem những sảm phẩm khác nhé!");
            }
    }
}
