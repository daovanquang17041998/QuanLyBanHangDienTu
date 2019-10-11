@extends('admin.layout.master')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sản phẩm
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Chuyên mục</th>
                                <th>Mô tả</th>
                                <th>Status</th>
                                <th>Add</th>
                                <th>Delete</th>
                                <th>Edit</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr class="odd gradeX" align="center">
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product->description}}</td>
                                <td> @if($product->status==1) Còn hàng @else Hết hàng @endif</td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/san-pham/chi-tiet/them/{{$product->id}}">Thêm</a></td>
                                <td class="center"  ><i class="fa fa-trash-o fa-fw"></i> <a href="admin/san-pham/xoa/{{$product->id}})"  >Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/san-pham/sua/{{$product->id}}">Sửa</a></td>
                                <td class="center"><i class="fa fa-search fa-fw"></i> <a href="admin/san-pham/chi-tiet/{{$product->id}}">Chi Tiết</a></td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Bảng size</h4>
                      </div>
                      <div class="modal-body">
                        
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
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