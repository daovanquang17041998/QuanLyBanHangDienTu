@extends("admin.layout.master")
@section("content")

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sản phẩm
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors)>0)
                        <div class="alert alert-warning" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        @foreach($errors->all() as $err)
                            {{$err}} <br>
                        @endforeach
                        </div>
                    @endif
                    @if(!empty(session('message')))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{session('message')}}
                        </div>
                    @endif
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input class="form-control" name="txtName" placeholder="Nhập tên đầy đủ" value="{{old('txtName')}}"/>
                        </div>
                        <div class="form-group">
                                <label>Danh mục</label>
                                <select class="form-control" name="selectCategoryId">
                                    @foreach($cates as $cate)
                                        <option value='{{$cate->id}}'>{{$cate->name}}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea id="description" class="form-control" name="txtDescription" placeholder="Nhập mô tả" value="{{old('txtDescription')}}"></textarea>
                            <script type="text/javascript" language="javascript">
                                CKEDITOR.replace('description');
                            </script>
                        </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <label class="radio-inline">
                                    <input name="rdoNew" value="1" checked="" type="radio">Nổi bật
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoNew" value="0" type="radio">Bình thường
                                </label>
                            </div>

                            <button type="submit" class="btn btn-default">Thêm</button>
                            <a href="admin/san-pham/danh-sach" class="btn btn-default">Trở về</a>
                        </div>
                    {{csrf_field()}}
                    <form>
                </div>
            </div>
        </div>
@endsection