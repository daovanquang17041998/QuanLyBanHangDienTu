@extends('admin.layout.master')
@section('content')
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Nhà cung cấp
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên nhà cung cấp</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Xóa</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $stt = 1;?>
                            @foreach($suppliers as $supplier)
                            <tr class="odd gradeX" align="center">
                                <td>{{$supplier->id}}</td>
                                <td>{{$supplier->name}}</td>
                                <td>{{$supplier->address}}</td>
                                <td>{{$supplier->phone}}</td>
                                <td class="center"><i class="fa fa-trash-o fa-fw "></i><a href="admin/nha-cung-cap/xoa/{{$supplier->id}}" class='btn-del'>Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/nha-cung-cap/sua/{{$supplier->id}}">Sửa</a></td>
                            </tr>
                            <?php $stt++;?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
