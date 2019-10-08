@extends('layout/master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Đăng kí</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb">
                <a href="{{route('trang-chu')}}">Trang chủ</a> / <span>Đăng kí</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">

        <form action="{{route('dangky')}}" method="post" class="beta-form-checkout">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
                <div class="col-sm-3"></div>
                @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach($errors ->all() as $err)
                                {{$err}}
                            @endforeach
                        </div>
                @endif
                @if(Session::has('thanhcong'))
                    <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
                @endif
                <div class="col-sm-6">
                    <h4>Đăng kí</h4>
                    <div class="space20">&nbsp;</div>
                    <div class="form-block">
                        <label for="email">Email address*</label>
                        <input type="email" name="email" id="email" required>
                    </div>

                    <div class="form-block">
                        <label for="your_last_name">Họ tên*</label>
                        <input type="text" name="fullname" id="your_last_name" required>
                    </div>

                    <div class="form-block">
                        <label for="adress">Địa chỉ*</label>
                        <input type="text" name="address" id="adress" value="Street Address" required>
                    </div>


                    <div class="form-block">
                        <label for="phone">Số điện thoại*</label>
                        <input type="text" id="phone" name="phone" required>
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
                        <label>Ngày sinh</label>
                        <input type='date' class="form-control" name="birthday" placeholder="Nhập vào ngày sinh" />
                    </div>
                    <div class="form-group">
                        <label>Avatar</label>
                        <input type='file' class="form-control" name="avatar" placeholder="Nhập vào ảnh đại diện" />
                    </div>
                    <div class="form-group">
                        <label style="margin-right: 20px">Trạng thái</label>
                        <label class="radio-inline">
                            <input name="status" value="1" type="radio" checked="">Dùng
                        </label>
                    </div>
                    <div class="form-group">
                        <label style="margin-right: 20px">Quyền hạn</label>
                        <label class="radio-inline">
                            <input name="quyen" value="0" type="radio" checked="">Người dùng
                        </label>
                    </div>
                    <div class="form-block">
                        <label for="phone">Mật khẩu*</label>
                        <input type="password" id="phone" name="password" required>
                    </div>
                    <div class="form-block">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </form>
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection