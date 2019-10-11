@extends("admin.layout.master")
@section("content")
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Hóa Đơn Nhập
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="col-lg-7" style="padding-bottom:120px">
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
                    <a href="admin/nhap-hang/danh-sach" class="btn btn-default">Trở về</a>
                        <div class="form-group">
                            <label>Nhân viên</label>
                            <select class="form-control" name="selectUserId">
                                @foreach($users as $user)
                                    @if($user->level>=1)
                                    <option value='{{$user->id}}'>  {{$user->fullname}} </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                                <label>Nhà cung cấp</label>
                                <select class="form-control" name="selectSuppplierId">
                                    @foreach($suppliers as $supplier)
                                        <option value='{{$supplier->id}}'>{{$supplier->name}}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Tổng tiền</label>
                            <input class="form-control" name="txtTotalMoney" placeholder="Nhập tổng tiền" value="{{old('txtTotalMoney')}}"/>
                        </div>
                        <div class="form-group">
                            <label>Phương thức thanh toán</label>
                            <input class="form-control" name="txtPayment" placeholder="Nhập phương thức thanh toán" value="{{old('txtPayment')}}"/>
                        </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    {{csrf_field()}}
                    <form>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection