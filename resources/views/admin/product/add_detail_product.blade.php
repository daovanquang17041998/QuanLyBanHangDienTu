@extends("admin.layout.master")
@section("content")
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Detail Product
                            <small>Add</small>
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
                    <a href="admin/chi-tiet/{$id}" class="btn btn-default">Trở về</a>
                        <div class="form-group">
                            <label>Tên sản phẩm</label><br>
                            <select class="form-control" name="selectProductId">
                                    <option value='{{$product->id}}'>{{$product->name}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                                <label>Màu sắc</label>
                                <select class="form-control" name="selectColorId">
                                    @foreach($color as $colors)
                                        <option value='{{$colors->id}}'>{{$colors->name}}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Bộ nhớ</label>
                            <select class="form-control" name="selectMemoryId">
                                @foreach($memory as $memories)
                                    <option value='{{$memories->id}}'>{{$memories->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Màn hình</label>
                            <select class="form-control" name="selectScreemId">
                                @foreach($screem as $screems)
                                    <option value='{{$screems->id}}'>{{$screems->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Đơn giá</label>
                            <input class="form-control" name="txtUnitprice" placeholder="Nhập đơn giá" value="{{old('txtUnitprice')}}"/>
                        </div>
                        <div class="form-group">
                            <label>Giá khuyến mãi</label>
                            <input class="form-control" name="txtPromotionprice" placeholder="Nhập giá khuyến mãi" value="{{old('txtPromotionprice')}}"/>
                        </div>
                        <div class="form-group">
                            <label>Hình đại diện</label>
                            <input type="file" class="form-control" name="txtAvatar" placeholder="Nhập hình đại diện" value="{{old('txtAvatar')}}"/>
                        </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input class="form-control" name="txtQuanlity" placeholder="Nhập số lượng" value="{{old('txtQuanlity')}}"/>
                            </div>

                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    {{csrf_field()}}
                    <form>
                </div>
            </div>
        </div>
@endsection