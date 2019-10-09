@extends('admin.layout.master')
@section('content')
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chi tiết sản phẩm
                            <small>Chi tiết</small>
                        </h1>
                    </div>
                    <div class="col-lg-12">
                        <table class="table__info-customer">
                            <tr>
                                <td class='td-left'>Họ và tên:</td>
                                <td>{{$customer->fullname}}</td>
                            </tr>
                            <tr>
                                <td>Số điện thoại:</td>
                                <td>{{$customer->phone}}</td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td>{{$customer->email}}</td>
                            </tr>
                            <tr>
                                <td>Địa chỉ</td>
                                <td>{{$customer->address}}</td>
                            </tr>
                            <tr>
                                <td>Tổng tiền</td>
                                <td>{{number_format($bill->total_price)}} vnđ</td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Sản phẩm</th>
                                <th>Số seri</th>
                                <th>Đơn giá</th>
                                <th>Delete</th>
                              
                            </tr>
                        </thead>
                        <tbody class="table__list_item">
                            @foreach($product_items as $item)
                            <tr class="odd gradeX" align="center">
                                <td>{{$item->id}}</td>
                                <td>{{$item->color}}</td>
                                <td>{{$item->detail_product->serial}}</td>
                                <td>
                                    @if($item->price != null) {{$item->price}} vnđ @else Không xác định @endif
                                </td>
                                <td class="center"><i class="fa fa-trash-o fa-fw "></i><a href="admin/don-hang/chi-tiet/xoa/{{$item->id}}" class='btn-del'> Delete</a></td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
