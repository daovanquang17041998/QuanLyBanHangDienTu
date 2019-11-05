@extends('layout/master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Giới thiệu</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{'#'}}">Trang chủ</a> / <span>Giới thiệu</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="container">
    <div id="content">
        <h2 class="text-center wow fadeInDownwow fadeInDown">Mobi Store</h2>
        <div class="space20">&nbsp;</div>
        <h5 class="text-center other-title wow fadeInLeft">Người đồng sáng lập</h5>
        <p class="text-center wow fadeInRight">Hãng điện thoại Mobi store <br />Trọng Quang</p>
        <div class="space20">&nbsp;</div>
        <div class="row">
            <div class="col-sm-6 wow fadeInLeft">
                <div class="beta-person media">

                    <img class="pull-left" src="uploads/introduce/banner2.jpg"  height="350px" width="600px" alt="">

                    <div class="media-body beta-person-body">
                        <h5>Cơ sở Hà Nội</h5>
                        <p class="font-large">Người quản lý</p>
                        <p>Nguyễn Duy Toản</p>
                        <a href="#">Xem chi tiết<i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 wow fadeInRight">
                <div class="beta-person media ">

                    <img class="pull-left" src="uploads/introduce/banner4.jpg" height="350px" width="600px" alt="">

                    <div class="media-body beta-person-body">
                        <h5>Cơ sở Hồ Chí Minh</h5>
                        <p class="font-large">Người quản lý</p>
                        <p>Hà Văn Nam</p>
                        <a href="#">Xem chi tiết<i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
