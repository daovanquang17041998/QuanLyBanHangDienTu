@extends('layout/master')
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Đặt hàng</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <a href="{{route('trang-chu')}}">Trang chủ</a> / <span>Đặt hàng</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">

            <form action="{{route('dathang')}}" method="post" class="beta-form-checkout">
                <input type="hidden" name="_tocken" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Đặt hàng</h4>
                        <div class="space20">&nbsp;</div>

                        <div class="form-block">
                            <label for="name">Họ tên*</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-block">
                            <label for="gender">Giới tính</label>
                            <input id="gender" type="radio" class="input" name="gender" value="nam
                             " checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
                            <input id="gender" type="radio" class="input" name="gender" value="nu
                             "  style="width: 10%"><span style="margin-right: 10%">Nữ</span>
                        </div>

                        <div class="form-block">
                            <label for="email">Email*</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-block">
                            <label for="adress">Địa chỉ*</label>
                            <input type="text" id="adress" name="adress" value="Street Address" required>
                        </div>

                        <div class="form-block">
                            <label for="phone">Điện thoại*</label>
                            <input type="text" id="phone" name="phone" required>
                        </div>

                        <div class="form-block">
                            <label for="notes">Ghi chú</label>
                            <textarea id="notes" name="note"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="your-order">
                            <div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
                            <div class="your-order-body">
                                <div class="your-order-item">
                                     <div>
                                     @foreach($product_cart as $cart)

                                        <div class="media">
                                            <img width="35%" src="uploads/product/{{$cart->attributes->image}}" alt="" class="pull-left">
                                            <div class="media-body">
                                                <p class="font-large"></p>
                                                <span class="color-gray your-order-info">Sản phẩm: {{$cart->name}}</span>
                                                <span class="color-gray your-order-info">Đơn giá: {{number_format($cart->price)}}đ</span>
                                                <span class="color-gray your-order-info">Số lương: {{number_format($cart->quantity)}} </span>
                                            </div>
                                        </div>
                                     @endforeach
                                     </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="your-order-item">
                                    <div class="pull-left"><p class="your-order-f18">Tổng tiền: </p></div>
                                    <div class="pull-right"><h5 class="color-black">{{number_format(\Cart::getSubTotal())}}</h5></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="your-order-head"><h5>Hình thức thanh toán</h5></div>

                            <div class="your-order-body">
                                <ul class="payment_methods methods">
                                    <li class="payment_method_bacs">
                                        <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="bacs" checked="checked" data-order_button_text="">
                                        <label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
                                        <div class="payment_box payment_method_bacs" style="display: block;">
                                           Cửa hàng sẽ gửi hàng đến địa chỉ của bạn. Bạn xem hàng rồi thanh toán cho nhân viên cửa hàng.
                                        </div>
                                    </li>

                                    <li class="payment_method_cheque">
                                        <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="cheque" data-order_button_text="">
                                        <label for="payment_method_cheque">Chuyển khoản </label>
                                        <div class="payment_box payment_method_cheque" style="display: none;">
                                            Vui lòng gửi séc của bạn đến Trọng Quang Mobie, Số 3, Huyện Sóc Sơn, Thành phố Hà Nội.
                                        </div>
                                    </li>

                                </ul>
                            </div>
                            <div class="text-center"><button  type="submit" class="beta-btn primary" href="#">Hãy Đặt hàng <i class="fa fa-chevron-right"></i></button></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection