@extends('layout/master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Loại sản phẩm {{$loai_sp->name}}</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{route('trang-chu')}}">Home</a> / <span>Loại sản phẩm</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                <div class="col-sm-3">
                    <ul class="aside-menu">
                        <h3>Thương hiệu</h3>
                        @foreach($loai as $l)
                            <li><a href="{{route('loaisanpham',$l->id)}}">{{$l->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-9">
                    <div class="beta-products-list">
                        <h4>Sản phẩm mới</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm thấy {{count($chi_tiet)}} sản phẩm</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @foreach($chi_tiet as $sp)
                            <div class="col-sm-4">
                                <div class="single-item">
                                    @if($sp->promotion_price!=0)
                                        <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                    @endif
                                    <div class="single-item-header">
                                        <a href="{{route('chitietsanpham',$sp->id)}}"><img src="uploads/product/{{$sp->image}}" alt="" height="250px"></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{$sp->name}}</p>
                                        <p class="single-item-price" style="font-size: 18px">
                                            @if($sp->promotion_price==0)
                                                <span class="flash-sale">{{number_format($sp->unit_price)}}<u>đ</u></span>
                                            @else
                                            <span class="flash-del">{{number_format($sp->unit_price)}}<u>đ</u></span>
                                            <span class="flash-sale">{{number_format($sp->promotion_price)}}<u>đ</u></span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="{{route('themgiohang',$sp->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="{{route('chitietsanpham',$sp->id)}}">Details <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                                <div class="space10">&nbsp;</div>
                           @endforeach
                        </div>
                        <div class="row">{{$chi_tiet->links()}}</div>
                    </div>

                    <div class="space50">&nbsp;</div>

                    <div class="beta-products-list">
                        <h4>Sản phẩm khác</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm thấy {{count($sp_khac)}} sản phẩm</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @foreach($sp_khac as $spkhac)
                                <div class="col-sm-4">
                                    <div class="single-item">
                                        @if($spkhac->promotion_price!=0)
                                            <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                        @endif
                                        <div class="single-item-header">
                                            <a href="{{route('chitietsanpham',$spkhac->id)}}"><img src="uploads/product/{{$spkhac->image}}" alt="" height="250px"></a>
                                        </div>
                                        <div class="single-item-body">
                                            <p class="single-item-title">{{$spkhac->name}}</p>
                                            <p class="single-item-price" style="font-size: 18px">
                                                @if($spkhac->promotion_price==0)
                                                    <span class="flash-sale">{{number_format($spkhac->unit_price)}}<u>đ</u></span>
                                                @else
                                                    <span class="flash-del">{{number_format($spkhac->unit_price)}}<u>đ</u></span>
                                                    <span class="flash-sale">{{number_format($spkhac->promotion_price)}}<u>đ</u></span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                            <a class="add-to-cart pull-left" href="{{route('themgiohang',$spkhac->id)}}.html"><i class="fa fa-shopping-cart"></i></a>
                                            <a class="beta-btn primary" href="{{route('chitietsanpham',$spkhac->id)}}">Details <i class="fa fa-chevron-right"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="space10">&nbsp;</div>
                            @endforeach
                        </div>
                        <div class="row">{{$sp_khac->links()}}</div>
                        <div class="space40">&nbsp;</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection