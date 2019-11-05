@extends('admin.layout.master')
@section('content')
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sản phẩm
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Chuyên mục</th>
                                <th>Mô tả</th>
                                <th>Trạng thái</th>
                                <th>Thêm</th>
                                <th>Xóa</th>
                                <th>Sửa</th>
                                <th>Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr class="odd gradeX" align="center">
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product->description}}</td>
                                <td> @if($product->status==1) Nổi bật @else Bình thường @endif</td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/san-pham/chi-tiet/them/{{$product->id}}">Thêm</a></td>
                                <td class="center"  ><i class="fa fa-trash-o fa-fw"></i> <a href="admin/san-pham/xoa/{{$product->id}})"  class='btn-del' >Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/san-pham/sua/{{$product->id}}">Sửa</a></td>
                                <td class="center"><i class="fa fa-search fa-fw"></i> <a href="admin/san-pham/chi-tiet/{{$product->id}}">Chi Tiết</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection