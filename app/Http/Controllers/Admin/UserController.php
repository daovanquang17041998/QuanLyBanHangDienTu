<?php

namespace App\Http\Controllers\Admin;

use App\BillExport;
use App\BillImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\User;
class UserController extends Controller
{
    public function getAddUser()
    {
    	return view('admin.user.add_user');
    }
    public function postAddUser(Request $request)
    {
    	$this->validate($request,[
    		'txtEmail' => 'required|email|unique:users,email',
            'txtFullName' => 'required|max:250',
            'txtAddress' => 'required|max:250',
            'txtPass' => 'required|max:12|min:6',
            'repassword'=>'required|same:txtPass|min:6|max:12',
            'txtPhoneNumber' => 'required|numeric',
            'txtBirthday' => 'required',
    	],[
    		"txtEmail.unique"    => "Email đã tồn tại",
            "txtEmail.email"    => "Chưa đúng định dạng email",
            "txtEmail.required"    => "Bạn phải nhập email",
            "txtFullName.required"    => "Bạn phải nhập tên",
            "txtFullName.max"    => "Tên không quá 250 kí tự",
            "txtPass.required"    => "Bạn phải nhập mật khẩu",
            "txtPass.min"    => "Mật khẩu ít nhất 6 kí tự",
            "txtPass.max"    => "Mật khẩu không quá 12 kí tự",
            "repassword.required"    => "Bạn phải nhập lại mật khẩu",
            "repassword.same"    => "Mật khẩu không khớp nhau",
            "repassword.min"    => "Nhập lại mật khẩu ít nhất 6 kí tự",
            "repassword.max"    => "Nhập lại mật khẩu không quá 12 kí tự",
            "txtPhoneNumber.required"    => "Bạn phải nhập số điện thoại",
            "txtPhoneNumber.numeric"    => "Số điện thoại phải là số",
            "txtBirthday.required"    => "Bạn phải nhập ngày sinh",
            "txtAddress.required"    => "Bạn phải nhập địa chỉ",
            "txtAddress.max"    => "Địa chỉ không quá 250 kí tự",
    	]);

		$user           = new User;
        $user->fullname     = $request->txtFullName;
		$user->email    = $request->txtEmail;
		$user->password = bcrypt($request->txtPass);
        $user->gender     = $request->rdoGender;
        $user->phone     = $request->txtPhoneNumber;
        $user->birthday     = $request->txtBirthday;
        $user->address     = $request->txtAddress;
        $user->status     = $request->rdoStatus;
		$user->level    = $request->rdoQuyen;
        $get_image = $request->file('txtAvatar');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $get_image->move('uploads/users',$get_name_image);
            $user->avatar = $get_name_image;
            $user->save();
            return redirect('admin/user/them')->with('message','Thêm thành công');
        }
        else
        $user->avatar ="";
    	$user->save();
    	return redirect('admin/user/them')->with('message','Thêm thành công');
    }
    public function getListUser()
    {
    	$users = User::all();
    	return view('admin.user.list_user',compact('users'));
    }

    public function getEditUser($id)
    {
    	$user = User::find($id);
    	return view('admin.user.edit_user',compact('user'));
    }

    public function postEditUser(Request $request, $id)
    {
        $this->validate($request,[
            'txtFullName' => 'required|max:250',
            'txtEmail'     => "required|email|unique:users,email,".$id,
        ],[
            'txtFullName.required' => "Bạn chưa nhập tên",
            'txtFullName.max'      => "Tên không quas 250 kí tự",
            'txtEmail.required'     => "Bạn chưa nhập Email",
            'txtEmail.email'        => "Bạn chưa nhập đúng định dạng Email",
            "txtEmail.unique"       => "Email đã tồn tại",
        ]);

        $user             = User::find($id);
        $user->fullname = $request->txtFullName;
        $user->email      = $request->txtEmail;
        $user->level      = $request->rdoQuyen;    
        $user->save();

        return redirect('admin/user/sua/'.$id)->with('message','Sửa thành công');
    }
    public function getDelUser($id)
    {
        $bill_import = BillImport::all();
        foreach ($bill_import as $bill_imports):
            if($bill_imports->id_user==$id){
                return redirect('admin/user/danh-sach')->with('error','Không thể xóa tài khoản này');
            }
        endforeach;
        $bill_export = BillExport::all();
        foreach ($bill_export as $bill_exports):
            if($bill_exports->id_user==$id){
                return redirect('admin/user/danh-sach')->with('error','Không thể xóa tài khoản này');
            }
        endforeach;
        $user = User::find($id);
        $user->delete();
        return redirect('admin/user/danh-sach')->with('message','Xóa thành công');
    }
    public function getAdminLogin()
    {
            return view('admin.login');
    }
    public function postAdminLogin(Request $request)
    {
        $this->validate($request,[
            'txtEmail'   => "required",
            'txtPass'    => "required"
        ],[
            'txtEmail.required' => "Bạn chưa nhập Email",
            'txtPass.required'  => "Bạn chưa nhập Mật khẩu",
        ]);
        $email = $request->txtEmail;
        $password = $request->txtPass;
        if (Auth::attempt(['email' => $email, 'password' => $password,'level'=>1])) {
            return redirect()->route('admin-index');
        }else{
            return redirect('admin/dang-nhap')->with('loi','Sai Email hoặc mật khẩu hoặc bạn không có quyền đăng nhập vào trang này');
        }
    }
    public function getAdminLogout()
    {
        if(Auth::guard()->check())
        {
            Auth::guard()->logout();
            return redirect('admin/dang-nhap');
        }
    }
    public function getInfoUser(){

    }
}
