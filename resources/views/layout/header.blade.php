<div id="header">
    <div class="header-top">
        <div class="container">
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li><a href=""><i class="fa fa-home"></i> Thôn Chùa, Đức Hòa, Sóc Sơn, Hà Nội</a></li>
                    <li><a href=""><i class="fa fa-phone"></i> 0343417170</a></li>
                </ul>
            </div>
            <div class="pull-right auto-width-right">
                <ul class="top-details menu-beta l-inline">
                    @if(Auth::check())
                        <li><a href="">Chào mừng: {{Auth::user()->fullname}}</a></li>
                        <li><a href="{{route('dangxuat')}}">Đăng xuất</a></li>
                    @else
                        <li><a href="{{route('dangky')}}">Đăng kí</a></li>
                        <li><a href="{{route('dangnhap')}}">Đăng nhập</a></li>
                    @endif

                </ul>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-top -->
    <div class="header-body">
        <div class="container beta-relative">
            <div class="pull-left">
                <a href="index.html" id="logo"><img src="uploads/slide/mobi.jpg"height="100px" width="350px" alt=""></a>
            </div>
            <div class="pull-right beta-components space-left ov">
                <div class="space10">&nbsp;</div>
                <div class="beta-comp">
                    <form role="search" method="get" id="searchform" action="{{route('search')}}">
                        <input type="text" value="" name="key" id="s" placeholder="Nhập từ khóa..." />
                        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                    </form>
                </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-body -->
    <div class="header-bottom" style="background-color: #0277b8;">
        <div class="container">
            <a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
            <div class="visible-xs clearfix"></div>
            <nav class="main-menu">
                <ul class="l-inline ov">
                    <li><a href="{{route('trang-chu')}}">Trang chủ</a></li>
                    <li><a href="{{route('trang-chu')}}">Loại Sản phẩm</a>
                        <ul class="sub-menu">
                            @foreach($loai_sp as $loai)
                                <li><a href="{{route('loaisanpham',$loai->id)}}">{{$loai->name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{route('gioithieu')}}">Giới thiệu</a></li>
                    <li><a href="{{route('thongtinlienhe')}}">Liên hệ</a></li>
                </ul>
                <div class="clearfix"></div>
            </nav>
        </div>
    </div>
</div>