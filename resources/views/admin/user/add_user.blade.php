@extends('admin.layout.master')
@section('content')
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tài khoản
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Warning!!</strong><br>
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif
                        @if(session('message'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Success</strong>
                                {{session('message')}}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Warning</strong>
                                {{session('loi')}}
                            </div>
                        @endif
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Họ tên*</label>
                                <input class="form-control" name="txtFullName" placeholder="Điền vào họ và tên User" value="{!! old('txtFullName') !!}"/>
                            </div>
                            <div class="form-group">
                                <label>Email*</label>
                                <input type='email' class="form-control" name="txtEmail" placeholder="Nhập vào Email"  value="{{ old('txtEmail') }}"/>
                            </div> 
                            <div class="form-group">
                                <label>Mật khẩu*</label>
                                <input type='password' class="form-control" name="txtPass" placeholder="Nhập vào Mật khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại Mật khẩu*</label>
                                <input type='password' class="form-control" name="repassword" placeholder="Nhập lại Mật khẩu" />
                            </div>
                            <div class="form-group">
                                <label style="margin-right: 20px">Giới tính</label>
                                <label class="radio-inline">
                                    <input name="rdoGender" value="0" type="radio" checked="">Nữ
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoGender" value="1"  type="radio">Nam
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại*</label>
                                <input type='number' class="form-control" name="txtPhoneNumber" placeholder="Nhập vào số điện thoại" />
                            </div>
                            <div class="form-group">
                                <label>Ngày sinh*</label>
                                <input type='date' class="form-control" name="txtBirthday" placeholder="Nhập vào ngày sinh" />
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ*</label>
                                <input type='text' class="form-control" name="txtAddress" placeholder="Nhập vào địa chỉ" />
                            </div>
                            <div class="form-group">
                                <label>Ảnh đại diện</label>
                                <input type='file' class="form-control" name="txtAvatar" placeholder="Nhập vào ảnh đại diện" />
                            </div>
                            <div class="form-group">
                                <label style="margin-right: 20px">Trạng thái</label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="1" type="radio" checked="">Dùng
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="0"  type="radio">Không
                                </label>
                            </div>
                             <div class="form-group">
                                <label style="margin-right: 20px">Quyền hạn</label>
                                <label class="radio-inline">
                                    <input name="rdoQuyen" value="0" type="radio" checked="">Người dùng
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoQuyen" value="1"  type="radio">Admin
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <a href="admin/user/danh-sach" class="btn btn-default">Trở về</a>
                            {{csrf_field()}}
                        <form>
                    </div>
                </div>
            </div>
    </div>
@endsection