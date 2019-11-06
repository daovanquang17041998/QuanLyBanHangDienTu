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
            return redirect()->route('trang-chu')->with('success','Đăng nhập thành công');
        }
        else{
            return redirect()->back()->with('error','Đăng nhập không thành công. Sai tài khoản hoặc mật khẩu');
        }
    }
    public function getSignup(){
        return view('page.dang_ky');
    }
    public function postSignup(Request $request){

        $this->validate($request,[
            'email' => 'required|email|unique:users,email',
            'fullname' => 'required|max:250',
            'address' => 'required|max:250',
            'password' => 'required|max:12|min:6',
            'phone' => 'required|numeric',
            'birthday' => 'required',
        ],[
            "email.unique"    => "Email đã tồn tại",
            "email.email"    => "Chưa đúng định dạng email",
            "email.required"    => "Bạn phải nhập email",
            "fullname.required"    => "Bạn phải nhập tên",
            "fullname.max"    => "Tên không quá 250 kí tự",
            "password.required"    => "Bạn phải nhập mật khẩu",
            "password.min"    => "Mật khẩu ít nhất 6 kí tự",
            "password.max"    => "Mật khẩu không quá 12 kí tự",
            "phone.required"    => "Bạn phải nhập số điện thoại",
            "phone.numeric"    => "Số điện thoại phải là số",
            "birthday.required"    => "Bạn phải nhập ngày sinh",
            "address.required"    => "Bạn phải nhập địa chỉ",
            "address.max"    => "Địa chỉ không quá 250 kí tự",
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
        return redirect()->back()->with('message','Đã tạo tài khoản thành công');
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
  public function getInfoUser(){
      return view('page.profile');
  }
  public function getEditUser(){
      return view('page.edit_profile');
  }
  public function postEditUser(Request $request){
      $this->validate($request,[
          'email' => 'required|email',
          'fullname' => 'required|max:250',
          'address' => 'required|max:250',
          'password' => 'required|max:12|min:6',
          'phone' => 'required|numeric',
          'birthday' => 'required',
      ],[
          "email.email"    => "Chưa đúng định dạng email",
          "email.required"    => "Bạn phải nhập email",
          "fullname.required"    => "Bạn phải nhập tên",
          "fullname.max"    => "Tên không quá 250 kí tự",
          "password.required"    => "Bạn phải nhập mật khẩu",
          "password.min"    => "Mật khẩu ít nhất 6 kí tự",
          "password.max"    => "Mật khẩu không quá 12 kí tự",
          "phone.required"    => "Bạn phải nhập số điện thoại",
          "phone.numeric"    => "Số điện thoại phải là số",
          "birthday.required"    => "Bạn phải nhập ngày sinh",
          "address.required"    => "Bạn phải nhập địa chỉ",
          "address.max"    => "Địa chỉ không quá 250 kí tự",
      ]);
      $user = User::find(Auth::user()->id);
      $user->fullname = $request->fullname;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->phone = $request->phone;
      $user->gender = $request->rdoGender;
      $user->birthday = $request->birthday;
      $user->status = Auth::user()->status;
      $user->level = Auth::user()->level;
      $user->address = $request->address;
      $user->address = $request->address;
      $get_image = $request->file('avatar');
      if($get_image){
          $get_name_image = $get_image->getClientOriginalName();
          $get_image->move('uploads/users',$get_name_image);
          $user->avatar = $get_name_image;
          $user->save();
          return redirect('profile/sua')->with('message','Sửa thông tin thành công');
      }
      else
      $user->avatar = "user.jpg";
      $user->save();
      return redirect('profile/sua')->with('message','Sửa thông tin thành công');
  }
}
