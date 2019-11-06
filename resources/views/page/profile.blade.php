@extends('layout/master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Tài khoản người dùng</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb">
                <a href="{{route('trang-chu')}}">Trang chủ</a> / <span>Tài khoản</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        <form action="" method="post" class="beta-form-checkout">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
                <div class="col-sm-6">
                    <h4>Thông tin</h4>
                    <div class="space20">&nbsp;</div>
                    <div class="form-block">
                        <label for="your_last_name">Họ tên: </label>{{Auth::user()->fullname}}
                    </div>
                    <div class="form-block">
                        <label for="email">Địa chỉ email: </label>{{Auth::user()->email}}
                    </div>
                    <div class="form-block">
                        <label for="adress">Địa chỉ: </label>{{Auth::user()->address}}
                    </div>
                    <div class="form-block">
                        <label for="phone">Số điện thoại: </label>{{Auth::user()->phone}}
                    </div>
                    <div class="form-block">
                        <label style="margin-right: 20px">Giới tính: </label>@if(Auth::user()->gender == 1)
                           Nam
                        @else
                            Nữ
                        @endif
                    </div>
                    <div class="form-block">
                        <label>Ngày sinh: </label>{{Auth::user()->birthday}}
                    </div>
                    <div class="form-block">
                        <label>Ảnh đại diện: </label>
                        <img src="../public/uploads/users/{{Auth::user()->avatar}}" height="100" width="100">
                    </div>
                    <div class="form-block">
                        <label style="margin-right: 20px">Trạng thái: </label>@if(Auth::user()->status == 1)
                           Dùng
                        @else
                            Không dùng
                         @endif
                    </div>
                    <div class="form-block">
                        <label style="margin-right: 20px">Quyền hạn: </label>@if(Auth::user()->level == 1)
                            admin
                        @else
                            Người dùng
                        @endif
                    </div>
                    <div class="form-block">
                        <a href="profile/sua" class="btn btn-primary">Sửa thông tin</a>
                    </div>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </form>
    </div>
</div>
@endsection