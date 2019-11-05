@extends('admin.layout.master')
@section('content')
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chi tiết sản phẩm
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    @if(session('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Success</strong>
                            {{session('message')}}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Warning</strong>
                            {{session('error')}}
                        </div>
                    @endif
                </div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh</th>
                                <th>Đơn giá</th>
                                <th>Giá khuyến mãi</th>
                                <th>Số lượng</th>
                                <th>Mô tả</th>
                                <th>Xóa</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($product_items as $product)
                            <tr class="odd gradeX" align="center">
                                <td>{{$product->id}}</td>
                                <td>{{$product->product->name}}</td>
                                <td><img src="../public/uploads/product/{{$product->image}}" height="100" width="100"> </td>
                                <td>{{number_format($product->unit_price)}}</td>
                                <td>{{number_format($product->promotion_price)}}</td>
                                <td>{{$product->quanlity}}</td>
                                <td>Màu: {{$product->color->name}} Màn hình:  {{$product->screem->name}} Bộ nhớ:  {{$product->memory->name}}</td>
                                <td class="center"><i class="fa fa-trash-o fa-fw" ></i><a href="admin/san-pham/chi-tiet/xoa/{{$product->id}}))" class='btn-del'>Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/san-pham/chi-tiet/sua/{{$product->id}}">Sửa</a></td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.view-size').click(function (){
                var id = $(this).attr('data-viewid');

                $.ajax({
                    url: "admin/ajax/view-size",
                    type: "post",
                    data: "product_id="+id,
                    async: true,
                    success:function(data)
                    {  
                        $(".modal-body").html(data);
                    }
                 });
             });
        });
        
    </script>
@endsection