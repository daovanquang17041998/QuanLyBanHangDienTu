@extends('admin.layout.master')
@section('content')
  <div id="page-wrapper">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-12">
                  <h1 class="page-header">Tổng quan
                  </h1>
              </div>
          <div class="row placeholders">
              <div class="col-xs-6 col-sm-3 placeholder" style="position: relative">
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
                  <h4 style="position: absolute;top: 50%;left: 50%;transform: translateX(-50%) translateY(-50%); color: white;">{{$user->count()}} thành viên</h4>
              </div>
              <div class="col-xs-6 col-sm-3 placeholder" style="position: relative">
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
                  <h4 style="position: absolute;top: 50%;left: 50%;transform: translateX(-50%) translateY(-50%); color: white;">{{$product->count()}} sản phẩm</h4>
              </div>
              <div class="col-xs-6 col-sm-3 placeholder" style="position: relative" >
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
                  <h4 style="position: absolute;top: 50%;left: 50%;transform: translateX(-50%) translateY(-50%); color: white;">5 lượt đánh giá</h4>
              </div>
              <div class="col-xs-6 col-sm-3 placeholder" style="position: relative" >
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
                  <h4 style="position: absolute;top: 50%;left: 50%;transform: translateX(-50%) translateY(-50%); color: white;">4 bài viết</h4>
              </div>
          </div>
          <h2 class="sub-header">Thống kê</h2>
          <div class="table-responsive">
              <table class="table table-striped">
                  <thead>
                  <tr>
                      <th>#</th>
                      <th>Header</th>
                      <th>Header</th>
                      <th>Header</th>
                      <th>Header</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <td>1,001</td>
                      <td>Lorem</td>
                      <td>ipsum</td>
                      <td>dolor</td>
                      <td>sit</td>
                  </tr>
                  <tr>
                      <td>1,015</td>
                      <td>sodales</td>
                      <td>ligula</td>
                      <td>in</td>
                      <td>libero</td>
                  </tr>
                  </tbody>
              </table>
          </div>
          </div>
      </div>
  </div>
@endsection