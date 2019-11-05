<?php

namespace App\Http\Controllers;

use App\Bill;
use App\BillDetail;
use App\Category;
use App\Customer;
use App\DetailBillExport;
use App\DetailProduct;
use App\Product;
use App\ProductType;
use App\Slide;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PageController extends Controller
{
    public function getIndexPage()
    {
        $slide = Slide::all();
        $new_product = DB::table('detail_product as a')->join('products as b','a.id_product','=','b.id')->where('b.status','=',1)->paginate(8);
        $sale_product = DetailProduct::where('promotion_price','<>',0)->paginate(4);
        return view('page.trangchu',compact('slide','new_product','sale_product'));
    }
    public function getLoaisanpham($type){
        $sp_theoloai = Product::where('id_category',$type)->get();
        $chi_tiet = DB::table('detail_product as a')->join('products as b','a.id_product','=','b.id')->join('categories_product as c','b.id_category','=','c.id')->
            select('a.*','b.name')->where('c.id',$type)->paginate(3);
        $sp_khac = DB::table('detail_product as a')->join('products as b','a.id_product','=','b.id')->join('categories_product as c','b.id_category','=','c.id')->
        select('a.*','b.name')->where('c.id','<>',$type)->paginate(6);
        $loai = Category::all();
        $loai_sp = Category::where('id',$type)->first();
        return view('page.loaisanpham',compact('sp_theoloai','sp_khac','loai','loai_sp','chi_tiet'));
    }
    public function getChitietsanpham(Request $request){
        $detail_product   = DetailProduct::where('id',$request->id)->first();
        $detail= DB::table('detail_product as a')->join('products as b','a.id_product','=','b.id')->join('categories_product as c','b.id_category','=','c.id')->
        select('a.*','b.*','c.id as idcate','c.*')->where('a.id',$request->id)->first();
        $sanpham_tuongtu = DB::table('detail_product as a')->join('products as b','a.id_product','=','b.id')->join('categories_product as c','b.id_category','=','c.id')->
        select('a.*','b.name')->where('c.id',$detail->idcate)->paginate(6);
        $sanpham_noibat = DB::table('detail_product as a')->join('products as b','a.id_product','=','b.id')->where('b.status','=',1)->paginate(8);
        return view('page.chitietsanpham',compact('detail_product','sanpham_tuongtu','sanpham_noibat'));
    }
    public function getLienhe(){
        return view('page.thongtinlienhe');
    }
    public function getGioithieu(){
        return view('page.gioithieu');
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
            'txtEmail' => 'email|unique:users,email'
        ],[
            "txtEmail.unique"    => "Email đã tồn tại",
            "txtEmail.email"    => "Chưa đúng định dạng email",
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
        \Cart::clear();
        return redirect()->route('trang-chu');
    }
    public function getSearch(Request $request){
        $detail_product = DB::table('detail_product as a')
            ->join('products as b','a.id_product','=','b.id')
            ->join('categories_product as c','b.id_category','=','c.id')
            ->select('a.*','b.name')->where('b.name','like','%'.$request->key.'%')
            ->orwhere('a.unit_price',$request->key)->get();
        return view('page.search',compact('detail_product'));
    }

}
