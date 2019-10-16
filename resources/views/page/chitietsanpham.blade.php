@extends('layout/master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Sản phẩm {{$detail_product->product->name}}</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{route('trang-chu')}}">Trang chủ</a> / <span>Chi tiết sản phẩm</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        <div class="row">
            <div class="col-sm-9">

                <div class="row">
                    <div class="col-sm-4">
                        <img src="uploads/product/{{$detail_product->image}}" alt="">
                    </div>
                    <div class="col-sm-8">
                        <div class="single-item-body">
                            <p class="single-item-title">{{$detail_product->product->name}}</p>
                            <p class="single-item-price">
                                @if($detail_product->promotion_price==0)
                                    <span class="flash-sale">{{number_format($detail_product->unit_price)}}<u>đ</u></span>
                                @else
                                    <span class="flash-del">{{number_format($detail_product->unit_price)}}<u>đ</u></span>
                                    <span class="flash-sale">{{number_format($detail_product->promotion_price)}}<u>đ</u></span>
                                @endif
                            </p>
                        </div>
                        <div class="space20">&nbsp;</div>
                        <p>Số lượng:</p>
                        <div class="single-item-options">
                            <select class="wc-select" name="color">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i></a>
                            <div class="clearfix"></div>
                        </div>
                        <div class="space20">&nbsp;</div>
                        <div class="woocommerce-tabs">
                            <ul class="tabs">
                                <li><a href="#tab-description">Mô tả</a></li>
                            </ul>
                        </div>
                    <div class="panel" id="tab-description">
                        <p>Đây là một {{$detail_product->product->description}}
                            Màu: {{$detail_product->color->name}}
                            Màn hình: {{$detail_product->screem->name}}
                            Bộ nhớ: {{$detail_product->memory->name}}
                        </p>
                    </div>
                </div>
                <div class="space50">&nbsp;</div>
                <div class="beta-products-list">
                    <h4>Sản phẩm tương tự</h4>
                    <div class="row">
                        @foreach($sanpham_tuongtu as $sptt)
                        <div class="col-sm-4">
                            <div class="single-item">
                                <div class="single-item-header">
                                    <a href="{{route('trang-chu')}}"><img src="uploads/product/{{$sptt->image}}" alt="" height="250px"></a>
                                </div>
                                <div class="single-item-body">
                                    <p class="single-item-title">{{$sptt->name}}</p>
                                    <p class="single-item-price" style="font-size: 18px">
                                        @if($sptt->promotion_price==0)
                                            <span class="flash-sale">{{number_format($sptt->unit_price)}} Đồng</span>
                                        @else
                                            <span class="flash-del">{{number_format($sptt->unit_price)}} Đồng</span>
                                            <span class="flash-sale">{{number_format($sptt->promotion_price)}} Đồng</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="single-item-caption">
                                    <a class="add-to-cart pull-left" href="product.html"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">{{$sanpham_tuongtu->links()}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection