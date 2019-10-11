@extends("admin.layout.master")
@section("content")
<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Nhập hàng
                        <small>Sửa</small>
                    </h1>
                </div>
                <a href="admin/nhap-hang/danh-sach" class="btn btn-default">Trở về</a>
                <!-- /.col-lg-12 -->
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
                                <label>Nhân viên</label>
                                <select class="form-control" name="selectUserId">
                                    @foreach($users as $user)
                                        @if($user->level==1)
                                        <option value='{{$user->id}}' @if($user->id == $bill_import->id_user) selected @endif >{{$user->fullname}}</option>
                                        @endif
                                    @endforeach
                                </select>
                         </div>
                    <div class="form-group">
                        <label>Nhà cung cấp</label>
                        <select class="form-control" name="selectSupplierId">
                            @foreach($suppliers as $supplier)
                                <option value='{{$supplier->id}}' @if($supplier->id == $bill_import->id_supplier) selected @endif >{{$supplier->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tổng tiền</label>
                        <input class="form-control" name="txtTotalMoney" placeholder="Nhập tổng tiền" value="{{$bill_import->totalmoney}}"/>
                    </div>
                    <div class="form-group">
                        <label>Phương thức thanh toán</label>
                        <input class="form-control" name="txtPayment" placeholder="Nhập phương thức thanh toán" value="{{$bill_import->payment}}"/>
                    </div>
                    <button type="submit" class="btn btn-default" name='ok'>Lưu lại</button>
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