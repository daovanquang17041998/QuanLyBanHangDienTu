@extends('admin.layout.master')
@section('content')
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Đơn hàng
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Khách hàng</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Ngày mua</th>
                                <th>Phương thức thanh toán</th>
                                <th>Tổng tiền</th>
                                <th>Add</th>
                                <th>Delete</th>
                                <th>Edit</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($bills as $bill)
                            <tr class="odd gradeX" align="center">
                                <td>{{$bill->id}}</td>
                                <?php $customer = App\User::find($bill->id_user);?>
                                <td>{{$customer->fullname}} </td>
                                <td>{{$customer->email}}</td>
                                <td>{{$bill->phone}}</td>
                                <td>
                                    <?php Carbon\Carbon::setLocale('vi') ; //dùng để đinh nghĩa time
                                    if(Carbon\Carbon::createFromTimestamp(strtotime($bill->created_at))->diffInHours() >= 24)
                                    {
                                        $date =  $bill->created_at;
                                    }
                                    else {
                                        $date =  Carbon\Carbon::createFromTimestamp(strtotime($bill->created_at))->diffforHumans();
                                    }
                                    ?>
                                    {{$date}}
                                </td>
                                <td><?php
                                    if($bill->payment)
                                    echo "Trực tiếp";
                                        else{
                                            echo "Chuyển khoản";
                                        }
                                    ?></td>
                                <td>
                                   {{number_format($bill->totalmoney)}}
                                </td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/don-hang/chi-tiet/them/{{$bill->id}}">Thêm</a></td>
                                <td class="center"><i class="fa fa-trash-o fa-fw "></i><a href="admin/don-hang/xoa/{{$bill->id}}" class='btn-del'> Xoá</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/don-hang/sua/{{$bill->id}}">Sửa</a></td>
                                <td class="center"><i class="fa fa-search fa-fw"></i> <a href="admin/don-hang/chi-tiet/{{$bill->id}}">Chi Tiết</a></td>
                            </tr>
                          
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
