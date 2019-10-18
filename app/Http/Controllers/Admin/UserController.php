<?php

namespace App\Http\Controllers\Admin;

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
    		'txtEmail' => 'required|unique:users,email',
            'txtFullName' => 'required',
            'txtAddress' => 'required',
            'txtPass' => 'required',
            'txtPhoneNumber' => 'required',
            'txtBirthday' => 'required',
    	],[
    		"txtEmail.unique"    => "Email đã tồn tại",
            "txtEmail.required"    => "Bạn phải nhập email",
            "txtFullName.required"    => "Bạn phải nhập tên",
            "txtPass.required"    => "Bạn phải nhập mật khẩu",
            "txtPhoneNumber.required"    => "Bạn phải nhập số điện thoại",
            "txtBirthday.required"    => "Bạn phải nhập ngày sinh",
            "txtAddress.required"    => "Bạn phải nhập địa chỉ",
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
            'txtFullName' => "required|min:2",
            'txtEmail'     => "required|email|unique:users,email,".$id,
        ],[
            'txtFullName.required' => "Bạn chưa nhập họ",
            'txtFullName.min'      => "Họ phải có ít nhất 2 kí tự",
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
        $user = User::find($id);
        $user->delete();
        return redirect('admin/user/danh-sach')->with('message','xóa thành công');
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
}
