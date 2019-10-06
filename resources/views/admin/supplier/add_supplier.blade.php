@extends('admin.layout.master')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Nhà cung cấp
                        <small>Sửa</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <div class="col-lg-12" style="padding-bottom:120px">
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
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
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label>Tên nhà cung cấp</label>
                                    <input class="form-control" name="txtSupplierName" placeholder="Nhập tên nhà cung cấp" value="{!! old('txtSupplierName')!!}"/>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input class="form-control" name="txtSupplierAddress" placeholder="Nhập địa chỉ nhà cung cấp" value="{!! old('txtSupplierAddress')!!}"/>
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input class="form-control" name="txtSupplierPhone" placeholder="Nhập số điện thoại nhà cung cấp" value="{!! old('txtSupplierPhone')!!}"/>
                                </div>
                                <button type="submit" class="btn btn-default">Thêm</button>
                                <button type="reset" class="btn btn-default">Hủy</button>
                                {{csrf_field()}}
                                <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection