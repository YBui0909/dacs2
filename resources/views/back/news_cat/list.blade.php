@extends('back.template.master')

@section('title', 'Quản lý danh mục tin tức')

@section('heading', 'Danh sách danh mục tin tức')

@section('news_cat', 'active');

@section('content')

    <div class="col-md-12 mx-auto">
        <!-- general form elements -->
        <div class="row">
            <div class="card card-primary col-md-12 mx-auto" style="padding: 0">
                <div class="card-header">
                    <a href="{{ url('admin/news_cat/add') }}" class="btn btn-block btn-light text-dark"
                        href="{{ url('admin/news_cat/add') }}" title="Thêm"
                        style="max-width: 100px; float: right; font-weight: 500">Thêm</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- form start -->
                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                        aria-describedby="example2_info">
                        <thead>
                            <tr>
                                <th class="sorting sorting_asc text-center" tabindex="0" aria-controls="example2"
                                    rowspan="1" colspan="1" aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending">
                                    Số thứ tự</th>
                                <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1"
                                    colspan="1" aria-label="Browser: activate to sort column ascending">Tên danh mục
                                </th>
                                <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1"
                                    colspan="1" aria-label="Platform(s): activate to sort column ascending">Trạng thái
                                </th>
                                <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1"
                                    colspan="1" aria-label="Browser: activate to sort column ascending"><i
                                        style="font-size: 20px" class="fa-solid fa-screwdriver-wrench"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 1;
                            @endphp
                            @if (isset($news_cat) && count($news_cat) > 0)
                                @foreach ($news_cat as $news_catData)
                                    <tr class="odd">
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $news_catData->Name }}</td>
                                        <td>{{ $news_catData->Status == 1 ? 'Mở' : 'Tắt' }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('admin/news_cat/edit/' . $news_catData->RowID) }}"
                                                title="Chỉnh sửa">
                                                <i class="fa-solid fa-pen-to-square" style="color: #db0b0b;"></i>
                                            </a>
                                            <a href="{{ url('admin/news_cat/delete/' . $news_catData->RowID) }}"
                                                title="Xoá" style="margin-left:3px;" onclick="return confirmDelete();">
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
            var result = confirm("Bạn có chắc chắn muốn xóa danh mục này?");
            return result;
        }
    </script>

@stop
