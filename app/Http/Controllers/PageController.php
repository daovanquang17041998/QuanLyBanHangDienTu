<?php

namespace App\Http\Controllers;

use App\Bill;
use App\BillDetail;
use App\Category;
use App\Customer;
use App\DetailProduct;
use App\Product;
use App\ProductType;
use App\Slide;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PageController extends Controller
{
    public function getIndexPage()
    {
        $slide = Slide::all();
        $new_product = DetailProduct::where('unit_price','<>',0)->paginate(4);
        $sale_product = DetailProduct::where('promotion_price','<>',0)->paginate(8);
        return view('page.trangchu',compact('slide','new_product','sale_product'));
    }
    public function getLoaisanpham($type){
        $sp_theoloai = Product::where('id_category',$type)->get();
        $sp_khac = Product::where('id_category','<>',$type)->paginate(3);
        $loai = Category::all();
        $loai_sp = Category::where('id',$type)->first();
        return view('page.loaisanpham',compact('sp_theoloai','sp_khac','loai','loai_sp'));
    }
    public function getChitietsanpham(Request $request){
        $detail_product        = DetailProduct::find($request->id);
        $sanpham = Product::where('id',$request->id)->first();
        $sanpham_tuongtu = Product::where('id_category',$sanpham->id_category)->paginate(6);
        return view('page.chitietsanpham',compact('sanpham','detail_product','sanpham_tuongtu'));
    }
    public function getLienhe(){
        return view('page.thongtinlienhe');
    }
    public function getGioithieu(){
        return view('page.gioithieu');
    }
    public function getAddToCart(Request $request,$id){
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart ->add($product,$id);
        $request->session()->put('cart',$cart);
        return redirect()->back();
    }
    public function getDelItemCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }
        else{
            Session::forget('cart');
        }
        return redirect()->back();
    }
    public function getCheckout(){
        return view('page.dat_hang');
    }
    public function postCheckout(Request $request){
        $cart = Session::get('cart');
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->gender = $request->gender;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->note = $request->note;
        $customer->save();

        $bill = new Bill;
        $bill->id_customer = $customer->id;
        $bill->date_orther = data(Y-m-d);
        $bill->total = $cart->totalPrice;
        $bill->payment_method = $request->payment_method;
        $bill->note = $request->note;
        $bill->save();

        foreach ($cart->items as $key => $value){
            $bill_detail = new BillDetail;
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = $value['price']/$value['qty'];
            $bill_detail->save();
        }
        session()->forget('cart');
        return redirect()->back()->with('thông báo','đặt hàng thành công');
    }
    public function getLogin(){
        return view('page.dang_nhap');
    }
    public function postLogin(Request $request){

        $credenttials = array('email'=>$request->email,'password'=>$request->password);
        if(Auth::attempt($credenttials)){
            return redirect()->route('trang-chu')->with(['flag'=>'success','message'=>'Đăng nhập thành công']);
        }
        else{
            return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập không thành công']);
        }

    }
    public function getSignup(){
        return view('page.dang_ky');
    }
    public function postSignup(Request $request){
        $this->validate($request,[
            'txtEmail' => 'unique:users,email'
        ],[
            "txtEmail.unique"    => "Email đã tồn tại",
        ]);
        $user = new User();
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->gender = $request->rdoGender;
        $user->birthday = $request->birthday;
        $user->status = $request->status;
        $user->level = $request->quyen;
        $user->address = $request->address;
        $user->address = $request->address;
        $get_image = $request->file('avatar');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $get_image->move('uploads/users',$get_name_image);
            $user->avatar = $get_name_image;
            $user->save();
            return redirect('dang-nhap')->with('message','Đã tạo tài khoản  thành công');
        }
        else
            $user->avatar ="";
        $user->save();
        return redirect()->back()->with("Đã tạo tài khoản thành công");
    }
    public function getLogout(){
        Auth::logout();
        return redirect()->route('trang-chu');
    }
    public function getSearch(Request $request){
        $product = Product::where('name','like','%'.$request->key.'%')->orwhere('unit_price',$request->key)->get();
        return view('page.search',compact('product'));
    }
}
