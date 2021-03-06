@extends('admin.layout.master')
@section('content')
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Nhà cung cấp
                            <small>Sửa</small>
                        </h1>
                    </div>
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <div class="col-lg-7" style="padding-bottom:120px">
                         @if(count($errors)>0)
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Warning!!</strong>
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
                                <input class="form-control" name="txtSupplierName" placeholder="Nhập tên danh mục" value="{!! $item->name!!}"/>
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input class="form-control" name="txtSupplierAddress" placeholder="Nhập tên danh mục" value="{!! $item->address!!}"/>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input class="form-control" name="txtSupplierPhone" placeholder="Nhập tên danh mục" value="{!! $item->phone!!}"/>
                            </div>
                            <button type="submit" class="btn btn-default">Lưu</button>
                            <a href="admin/nha-cung-cap/danh-sach" class="btn btn-default">Trở về</a>
                            {{csrf_field()}}
                        <form>
                    </div>
                </div>
            </div>
        </div>

@endsection