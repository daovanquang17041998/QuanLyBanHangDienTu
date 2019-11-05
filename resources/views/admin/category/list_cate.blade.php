@extends('admin.layout.master')
@section('content')
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh mục
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên danh mục</th>
                                <th>Xóa</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $stt = 1;?>
                            @foreach($cates as $cate)
                            <tr class="odd gradeX" align="center">
                                <td>{{$cate->id}}</td>
                                <td>{{$cate->name}}</td>
                                <td class="center"><i class="fa fa-trash-o fa-fw "></i><a href="admin/danh-muc/xoa/{{$cate->id}}" class='btn-del'>Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/danh-muc/sua/{{$cate->id}}">Sửa</a></td>
                            </tr>
                            <?php $stt++;?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
