@extends("admin.layout.master")
@section("content")
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chi Tiết Hóa Đơn Nhập
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
                        <div class="form-group">
                            <label>Tên sản phẩm</label><br>
                            <select class="form-control" name="selectDetailProductId">
                                @foreach($detail_product as $detail_products)
                                    <option value='{{$detail_products->id}}'>{{$detail_products->product->name.'/ '.$detail_products->color->name.'/ '.$detail_products->memory->name.'/ '.$detail_products->screem->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Số hóa đơn nhập</label>
                            <select class="form-control" name="selectBillImportId">
                                    <option value='{{$id_detail_product->id}}'>{{$id_detail_product->id}}</option>
                            </select>
                        </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input class="form-control" name="txtQuanlity" placeholder="Nhập số lượng" value="{{old('txtQuanlity')}}"/>
                            </div>

                            <button type="submit" class="btn btn-default">Thêm</button>
                        <a href="admin/nhap-hang/chi-tiet/{{$id_detail_product->id}}" class="btn btn-default">Trở về</a>
                        </div>
                    {{csrf_field()}}
                    </form>
                </div>
            </div>
        </div>
@endsection