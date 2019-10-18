@extends('layout/master')
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Giỏ hàng của bạn</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <a href="{{route('trang-chu')}}">Trang chủ</a> / <span>Giỏ hàng</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">

            <form action="{{route('giohang')}}" method="post" class="beta-form-checkout">
                <input type="hidden" name="_tocken" value="{{csrf_token()}}">
                <table class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Hình ảnh</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i =1?>
                    @foreach($product_cart as $cart)
                    <tr>
                        <td>#{{$i}}</td>
                        <td>{{$cart->name}}</td>
                        <td> <img height="100px" width="90px" src="uploads/product/{{$cart->attributes->image}}" alt="" class="pull-left"></td>
                        <td>{{number_format($cart->price)}}đ</td>
                        <td> {{number_format($cart->quantity)}}</td>
                        <td>{{number_format($cart->price * $cart->quantity)}}<u>đ</u> </td>
                        <td>
                            <a href=""><i class="fa fa-pencil"></i>Sửa</a>
                            <a href="{{url('del-cart',['id'=>$cart['id']])}}"><i class="fa fa-trash-o"></i>Xóa</a>
                        </td>
                    </tr>
                    <?php $i++?>
                    @endforeach
                    </tbody>
                </table>
                <h5 class="class pull-right">Tổng tiền thanh toán: {{number_format(\Cart::getSubTotal())}}<u>đ</u>   <a href="{{route('dathang')}}" class="btn btn-success">Thanh Toán</a></h5>
            </form>
        </div>
    </div>
@endsection