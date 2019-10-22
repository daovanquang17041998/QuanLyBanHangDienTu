@extends("admin.layout.master")
@section("content")
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Chi Tiết Sản Phẩm
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
                        <label>Tên sản phẩm</label>
                        <select class="form-control" name="selectProductId" disabled>
                            @foreach($product as $products)
                                <option value='{{$products->id}}'@if($products->id == $product_detail->id_product) selected @endif >{{$products->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Màu sắc</label>
                        <select class="form-control" name="selectColorId">
                            @foreach($color as $colors)
                                <option value='{{$colors->id}}'@if($colors->id == $product_detail->id_color) selected @endif >{{$colors->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Bộ nhớ</label>
                        <select class="form-control" name="selectMemoryId">
                            @foreach($memory as $memories)
                                <option value='{{$memories->id}}' @if($memories->id == $product_detail->id_memory) selected @endif>{{$memories->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Màn hình</label>
                        <select class="form-control" name="selectScreemId">
                            @foreach($screem as $screems)
                                <option value='{{$screems->id}}' @if($screems->id == $product_detail->id_screem) selected @endif>{{$screems->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Đơn giá</label>
                        <input class="form-control" name="txtUnitprice" placeholder="Nhập đơn giá" value="{{$product_detail->unit_price}}"/>
                    </div>
                    <div class="form-group">
                        <label>Giá khuyến mãi</label>
                        <input class="form-control" name="txtPromotionprice" placeholder="Nhập giá khuyến mãi" value="{{$product_detail->promotion_price}}"/>
                    </div>
                    <div class="form-group">
                        <label>Hình đại diện</label>
                        <img src="../public/uploads/product/{{$product_detail->image}}" height="100" width="100">
                        <input type="file" class="form-control" name="txtAvatar" placeholder="Nhập hình đại diện" value="{{$product_detail->image}}"/>
                    </div>
                    <div class="form-group">
                        <label>Số lượng</label>
                        <input class="form-control" name="txtQuanlity" placeholder="Nhập số lượng" value="{{$product_detail->quanlity}}"/>
                    </div>
                    <button type="submit" class="btn btn-default" name='ok'>Lưu lại</button>
                    <a href="admin/san-pham/danh-sach" class="btn btn-default">Trở về</a>
                </div>
                <div class="col-lg-5" >
                 {{csrf_field()}}
                <form>
            </div>
        </div>
    </div>
@endsection