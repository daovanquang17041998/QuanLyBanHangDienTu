@extends("admin.layout.master")
@section("content")
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chi Tiết Hóa Đơn Bán
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
                    <a href="admin/don-hang/chi-tiet/{$id}" class="btn btn-default">Trở về</a>
                        <div class="form-group">
                            <label>Tên sản phẩm</label><br>
                            <select class="form-control" name="selectDetailProductId">
                                @foreach($detail_product as $detail_products)
                                    <option value='{{$detail_products->id}}'>{{$detail_products->product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Số hóa đơn bán</label>
                            <select class="form-control" name="selectBillExportId">
                                @foreach($bill_export as $bill_exports)
                                    <option value='{{$bill_exports->id}}'>{{$bill_exports->id}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Đơn giá</label>
                            <input class="form-control" name="txtPrice" placeholder="Nhập đơn giá" value="{{old('txtPrice')}}"/>
                        </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input class="form-control" name="txtQuanlity" placeholder="Nhập số lượng" value="{{old('txtQuanlity')}}"/>
                            </div>

                            <button type="submit" class="btn btn-default">Thêm</button>
                        <a href="admin/don-hang/danh-sach" class="btn btn-default">Hủy</a>
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