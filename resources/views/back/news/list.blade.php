@extends('back.template.master')

@section('title', 'Quản lý danh sách tin tức')

@section('heading', 'Danh sách tin tức')

@section('news', 'active');

@section('content')
    <div class="col-md-12 mx-auto">
        <!-- general form elements -->
        <div class="row">
            <div class="card card-primary col-md-12 mx-auto" style="padding: 0">
                <div class="card-header">
                    <a href="{{ url('admin/news/add') }}" class="btn btn-block btn-light text-dark"
                        href="{{ url('admin/news/add') }}" title="Thêm"
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
                                    colspan="1" aria-label="Browser: activate to sort column ascending">Tên tin tức
                                </th>
                                <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1"
                                    colspan="1" aria-label="Browser: activate to sort column ascending">Thuộc danh mục
                                </th>
                                <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1"
                                    colspan="1" aria-label="Browser: activate to sort column ascending">Lượt xem
                                </th>
                                <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1"
                                    colspan="1" aria-label="Browser: activate to sort column ascending">Trạng thái
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
                            @if (isset($news) && count($news) > 0)
                                @foreach ($news as $newsData)
                                    <tr class="odd">
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $newsData->Name }}</td>
                                        <td>{{ $newsData->CategoryName }}</td>
                                        <td>{{ $newsData->Views }}</td>
                                        <td>{{ $newsData->Status == 1 ? 'Bật' : 'Tắt' }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('admin/news/edit/' . $newsData->RowID) }}" title="Chỉnh sửa">
                                                <i class="fa-solid fa-pen-to-square" style="color: #db0b0b;"></i>
                                            </a>
                                            <a href="{{ url('admin/news/delete/' . $newsData->RowID) }}" title="Xoá"
                                                style="margin-left:3px;" onclick="return confirmDelete();">
                                                <i class="fa-solid fa-trash" style="color: #007dfa;"></i>
                                            </a>
                                            <a style="cursor: pointer; margin-left:3px;" title="Gửi thông báo"
                                                onclick="confirmSendNotice({{ $newsData->RowID }})">
                                                <i class="fa-solid fa-envelopes-bulk"></i>
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
            var result = confirm("Bạn có chắc chắn muốn xóa bài viết này?");
            return result;
        }

        function confirmSendNotice(rowid) {
            var isConfirmed = confirm("Bạn có muốn thông báo bài viết này cho mọi người không?");

            if (isConfirmed) {
                sendNotice(rowid);
            }
        }

        function sendNotice(rowid) {
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/send-notice',
                type: 'POST',
                data: {
                    RowID: rowid,
                    _token: token
                },
                success: function(data) {
                    alert('Thông báo đã được gửi thành công!');
                },
                error: function(error) {
                    alert('error');
                }
            });
        }
    </script>

@stop
