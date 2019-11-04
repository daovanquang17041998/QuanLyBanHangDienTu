@extends("admin.layout.master")
@section("content")
<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Đơn hàng
                        <small>Sửa</small>
                    </h1>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                <div class="col-lg-7" style="padding-bottom:100px">
                @if(count($errors)>0)
                    <div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    @foreach($errors->all() as $err)
                        {{$err}} <br>
                    @endforeach
                    </div>
                @endif
                @if(!empty(session('message')))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{session('message')}}
                    </div>
                @endif
                         <div class="form-group">
                                <label>Khách hàng</label>
                                <select class="form-control" name="selectUserId">
                                    @foreach($users as $user)
                                        @if($user->level<1)
                                        <option value='{{$user->id}}' @if($user->id == $bill_export->id_user) selected @endif >{{$user->fullname}}</option>
                                        @endif
                                    @endforeach
                                </select>
                         </div>
                    <div class="form-group">
                        <label>Phương thức thanh toán</label>
                        <label class="radio-inline">
                            <input name="txtPayment" value="{{$bill_export->payment}}" checked="" type="radio">Trực tiếp
                        </label>
                        <label class="radio-inline">
                            <input name="txtPayment" value="{{$bill_export->payment}}" type="radio">Chuyển khoản
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <label class="radio-inline">
                            <input name="rdoNew" value="{{$bill_export->status}}" checked="" type="radio">Thanh toán
                        </label>
                        <label class="radio-inline">
                            <input name="rdoNew" value="{{$bill_export->status}}" type="radio">Chưa thanh toán
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input class="form-control" name="txtAddress" placeholder="Nhập địa chỉ" value="{{$bill_export->address}}"/>
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input class="form-control" name="txtPhone" placeholder="Nhập địa chỉ" value="{{$bill_export->phone}}"/>
                    </div>
                    <div class="form-group">
                        <label>Ghi chú</label>
                        <textarea class="form-control" name="txtNote" placeholder="Nhập ghi chú">{{$bill_export->note}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-default" name='ok'>Lưu lại</button>
                    <a href="admin/don-hang/danh-sach" class="btn btn-default">Trở về</a>
                </div>
                 {{csrf_field()}}
                <form>
            </div>
        </div>
    </div>
@endsection