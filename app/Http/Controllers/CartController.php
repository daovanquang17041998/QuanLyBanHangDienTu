<?php

namespace App\Http\Controllers;

use App\BillExport;
use App\DetailBillExport;
use App\DetailProduct;
use App\User;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

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
        if(isset($_POST['ok'])){
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
        }
        \Cart::clear();
        return redirect()->route('trang-chu');
    }
        }
}
