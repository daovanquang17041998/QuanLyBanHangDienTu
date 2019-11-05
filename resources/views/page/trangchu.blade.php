@extends('layout/master')
@section('content')
    <div class="fullwidthbanner-container">
        <div class="fullwidthbanner">
            <div class="bannercontainer" >
                <div class="banner" >
                    <ul>
                        @foreach($slide as $sl)
                            <li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
                                <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
                                    <div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="uploads/slide/{{$sl->image}}" data-src="uploads/slide/{{$sl->image}}" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('uploads/slide/{{$sl->image}}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="tp-bannertimer"></div>
        </div>
    </div>
    </div>
    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="beta-products-list">
                            <h4>Sản phẩm nổi bật</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">Tìm thấy {{count($new_product)}} sản phẩm</p>
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                                @foreach($new_product as $new)
                                    <div class="col-sm-3">
                                        <div class="single-item">
                                            @if($new->promotion_price!=0)
                                                <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                            @endif
                                            <div class="single-item-header">
                                                @if(!$new->quanlity)
                                                    <span style="position: absolute; background-color: red;color: white;">Tạm hết hàng</span>
                                                @endif
                                                <a href="{{route('chitietsanpham',$new->id)}}"><img src="uploads/product/{{$new->image}}" alt="" height="250px"></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{$new->name}}</p>
                                                <p class="single-item-price" style="font-size: 18px">
                                                    @if($new->promotion_price==0)
                                                        <span class="flash-sale">{{number_format($new->unit_price)}}đ</span>
                                                    @else
                                                        <span class="flash-del">{{number_format($new->unit_price)}}đ</span>
                                                        <span class="flash-sale">{{number_format($new->promotion_price)}}đ</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left" href="{{route('themgiohang',$new->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary" href="{{route('chitietsanpham',$new->id)}}">Chi tiết <i class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space10">&nbsp;</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">{{$new_product->links()}}</div>
                        <div class="space50">&nbsp</div>

                        <div class="beta-products-list">
                            <h4>Sản phẩm khuyến mãi</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">Tìm thấy {{count($sale_product)}} sản phẩm khuyễn mãi</p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                @foreach($sale_product as $sale)
                                    <div class="col-sm-3">
                                        <div class="single-item">
                                            @if($sale->promotion_price!=0)
                                                <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                            @endif
                                            <div class="single-item-header">
                                                @if(!$sale->quanlity)
                                                    <span style="position: absolute; background-color: red;color: white;">Tạm hết hàng</span>
                                                @endif
                                                <a href="{{route('chitietsanpham',$sale->id)}}"><img src="uploads/product/{{$sale->image}}" alt="" height="250px"></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{$sale->product->name}}</p>
                                                <p class="single-item-price" style="font-size: 18px">
                                                    <span class="flash-del">{{number_format($sale->unit_price)}}đ</span>
                                                    <span class="flash-sale">{{number_format($sale->promotion_price)}}đ</span>
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left" href="{{route('themgiohang',$sale->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary" href="{{route('chitietsanpham',$sale->id)}}">Chi tiết<i class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space10">&nbsp;</div>
                                @endforeach
                            </div>
                            <div class="row">{{$sale_product->links()}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection