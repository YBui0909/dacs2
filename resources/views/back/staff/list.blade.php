@extends('back.template.master')

@section('title', 'Danh sách nhân viên')

@section('heading', 'Danh sách nhân viên')

@section('content')

    <div class="col-md-12 mx-auto">
        <!-- general form elements -->
        <div class="row">
            <div class="card card-primary col-md-12 mx-auto" style="padding: 0">
                <div class="card-header">
                    <a href="{{ url('admin/staff/add') }}" class="btn btn-block btn-light text-dark"
                        href="{{ url('admin/staff/add') }}" title="Thêm"
                        style="max-width: 100px; float: right; font-weight: 500">Thêm</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- form start -->
                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                        aria-describedby="example2_info">
                        <thead>
                            <tr>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                    colspan="1" aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending">
                                    Số thứ tự</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending">Họ Và tên</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending">Cấp bậc</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending">Email</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">Điện thoại</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1"
                                    colspan="1" aria-label="Browser: activate to sort column ascending"><i style="font-size: 20px" class="fa-solid fa-screwdriver-wrench"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 1;
                            @endphp
                            @if (isset($user) && count($user) > 0)
                                @foreach ($user as $userData)
                                    <tr class="odd">
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $userData->fullname }}</td>
                                        <td>{{ $userData->name }}</td>
                                        <td>{{ $userData->email }}</td>
                                        <td>{{ $userData->phone }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('admin/staff/edit/' . $userData->id) }}" title="Chỉnh sửa">
                                                <i class="fa-solid fa-pen-to-square" style="color: #db0b0b;"></i>
                                            </a>
                                            <a href="{{ url('admin/staff/delete/' . $userData->id) }}" title="Xoá"
                                                style="margin-left:3px;" onclick="return confirmDelete();">
                                                <i class="fa-solid fa-trash" style="color: #007dfa;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
    <script>
        function confirmDelete() {
            var result = confirm("Bạn có chắc chắn muốn xóa nhân viên này?");
            return result;
        }
    </script>

@stop
