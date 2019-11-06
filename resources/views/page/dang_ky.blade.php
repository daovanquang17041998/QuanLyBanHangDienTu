@extends('layout/master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Đăng ký</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb">
                <a href="{{route('trang-chu')}}">Trang chủ</a> / <span>Đăng ký</span>
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
                @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach($errors ->all() as $err)
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
                            <strong>Warning!!</strong>
                            {{session('error')}}
                        </div>
                    @endif
                <div class="col-sm-6">
                    <h4>Thông tin</h4>
                    <div class="space20">&nbsp;</div>
                    <div class="form-block">
                        <label for="your_last_name">Họ tên*</label>
                        <input type="text" name="fullname" id="your_last_name">
                    </div>
                    <div class="form-block">
                        <label for="email">Địa chỉ email*</label>
                        <input type="email" name="email" id="email">
                    </div>
                    <div class="form-block">
                        <label for="phone">Mật khẩu*</label>
                        <input type="password" id="phone" name="password">
                    </div>
                    <div class="form-block">
                        <label for="phone">Nhập lại Mật khẩu*</label>
                        <input type="password" id="phone" name="repassword">
                    </div>
                    <div class="form-block">
                        <label for="adress">Địa chỉ*</label>
                        <input type="text" name="address" id="adress" value="Hà nội">
                    </div>
                    <div class="form-block">
                        <label for="phone">Số điện thoại*</label>
                        <input type="text" id="phone" name="phone">
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
                        <label>Ảnh đại diện</label>
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
                        <button type="submit" class="btn btn-primary">Đăng ký</button>
                    </div>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </form>
    </div>
</div>
@endsection