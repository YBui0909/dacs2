@extends('back.template.master')

@section('title', 'Quản lý trang')

@section('heading', 'Danh sách trang')

@section('page', 'active');

@section('content')

    <div class="col-md-12 mx-auto">
        <!-- general form elements -->
        <div class="row">
            <div class="card card-primary col-md-12 mx-auto" style="padding: 0">
                <div class="card-header">
                    <a href="{{ url('admin/page/add') }}" class="btn btn-block btn-light text-dark"
                        href="{{ url('admin/page/add') }}" title="Thêm"
                        style="max-width: 100px; float: right; font-weight: 500">Thêm</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- form start -->
                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                        aria-describedby="example2_info">
                        <thead>
                            <tr>
                                <th class="sorting sorting_asc text-center" tabindex="0" aria-controls="example2" rowspan="1"
                                    colspan="1" aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending">
                                    Số thứ tự</th>
                                <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending">Tên trang</th>
                                <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending">Trạng thái</th>
                                <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending">Sắp xếp</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1"
                                    colspan="1" aria-label="Browser: activate to sort column ascending"><i style="font-size: 20px" class="fa-solid fa-screwdriver-wrench"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 1;
                            @endphp
                            @if (isset($page) && count($page) > 0)
                                @foreach ($page as $pageData)
                                    <tr class="odd">
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $pageData->Name }}</td>
                                        <td>{{ $pageData->Status == 1 ? 'Bật' : 'Tắt' }}</td>
                                        <td>{{ $pageData->Sort }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('admin/page/edit/' . $pageData->RowID) }}" title="Chỉnh sửa">
                                                <i class="fa-solid fa-pen-to-square" style="color: #db0b0b;"></i>
                                            </a>
                                            <a href="{{ url('admin/page/delete/' . $pageData->RowID) }}" title="Xoá"
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
            var result = confirm("Bạn có chắc chắn muốn xóa trang này?");
            return result;
        }
    </script>

@stop
