@extends('admin.layout.master')
@section('content')
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Đơn hàng
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
                                <td>{{number_format($bill->totalmoney)}}<u>đ</u></td>
                            </tr>
                        </table>
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Sản phẩm</th>
                                <th>Ảnh</th>
                                <th>Mô tả</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                              
                            </tr>
                        </thead>
                        <tbody class="table__list_item">
                            @foreach($product_items as $item)
                            <tr class="odd gradeX" align="center">
                                <td>{{$item->id}}</td>
                                <td>{{$item->detail_product->product->name}}</td>
                                <td><img src="../public/uploads/product/{{$item->detail_product->image}}" height="100" width="100">
                                <td>Màu: {{$item->detail_product->color->name}} Màn hình: {{$item->detail_product->screem->name}} Bộ nhớ: {{$item->detail_product->memory->name}}</td>
                                <td>
                                    @if($item->price != null) {{number_format($item->price)}}<u>đ</u> @else Không xác định @endif
                                </td>
                                <td>{{$item->quanlity}}</td>
                                <td class="center"><i class="fa fa-pencil fa-fw "></i><a href="admin/don-hang/chi-tiet/sua/{{$item->id}}">Sửa</a></td>
                                <td class="center"><i class="fa fa-trash-o fa-fw "></i><a href="admin/don-hang/chi-tiet/xoa/{{$item->id}}" class='btn-del'>Xóa</a></td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
