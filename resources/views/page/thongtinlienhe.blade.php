@extends('layout/master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Liên hệ</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{'#'}}">Trang chủ</a> / <span>Liên hệ</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="beta-map">

    <div class="abs-fullwidth beta-map wow flipInX"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.1133656789016!2d105.80130561424535!3d21.028149493176652!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab424a50fff9%3A0xbe3a7f3670c0a45f!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBHaWFvIHRow7RuZyBW4bqtbiB04bqjaSAoVVRDKQ!5e0!3m2!1svi!2s!4v1571818484704!5m2!1svi!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe></div>
</div>
<div class="container">
    <div id="content" class="space-top-none">

        <div class="space50">&nbsp;</div>
        <div class="row">
            <div class="col-sm-8">
                <h2>Gửi biểu mẫu</h2>
                <div class="space20">&nbsp;</div>
                <p>Cửa hàng điện thoại di động số 1 Việt Nam. Chúng tôi luôn quan tâm và giúp đỡ mọi khách hàng. Hãy liên hệ với chúng tôi! </p>
                <div class="space20">&nbsp;</div>
                <form action="#" method="post" class="contact-form">
                    <div class="form-block">
                        <input name="your-name" type="text" placeholder="Tên của bạn(bắt buộc)">
                    </div>
                    <div class="form-block">
                        <input name="your-email" type="email" placeholder="Địa chỉ mail(bắt buộc)">
                    </div>
                    <div class="form-block">
                        <input name="your-subject" type="text" placeholder="Chủ đề">
                    </div>
                    <div class="form-block">
                        <textarea name="your-message" placeholder="Nội dung"></textarea>
                    </div>
                    <div class="form-block">
                        <button type="submit" class="beta-btn primary">Gửi tin nhắn<i class="fa fa-chevron-right"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-sm-4">
                <h2>Thông tin liên lạc</h2>
                <div class="space20">&nbsp;</div>

                <h6 class="contact-title">Địa chỉ</h6>
                <p>
                  Số 6, Đức Hòa, Sóc Sơn, Hà Nội.
                </p>
                <div class="space20">&nbsp;</div>
                <h6 class="contact-title">Liên hệ</h6>
                <p>
                    Chúng tôi luôn giải đáp những thắc mắc của bạn! <br>
                    <a href="aovanquang@gmail.com">aovanquang@gmail.com</a>
                </p>
                <div class="space20">&nbsp;</div>
                <h6 class="contact-title">Khẩu hiệu</h6>
                <p>
                   Chúng tôi luôn nhìn vào sự hài lòng của khách hàng để hoàn thiện hơn.<br>
                    <a href="aovanquang@gmail.com">aovanquang@gmail.com</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection