@extends('back.template.master')

@section('title', 'Quản lý liên hệ')

@section('heading', 'Danh sách liên hệ')

@section('contact', 'active');

@section('content')

    <div class="col-md-12 mx-auto">
        <!-- general form elements -->
        <div class="row">
            <div class="card card-primary col-md-12 mx-auto" style="padding: 0">
                {{-- <div class="card-header">
                    <a href="{{ url('admin/contact/add') }}" class="btn btn-block btn-light text-dark"
                        href="{{ url('admin/contact/add') }}" title="Thêm"
                        style="max-width: 100px; float: right; font-weight: 500">Thêm</a>
                </div> --}}
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
                                    colspan="1" aria-label="Browser: activate to sort column ascending">Tên</th>
                                <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1"
                                    colspan="1" aria-label="Browser: activate to sort column ascending">Email</th>
                                <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1"
                                    colspan="1" aria-label="Platform(s): activate to sort column ascending">Số điện thoại
                                </th>
                                <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1"
                                    colspan="1" aria-label="Engine version: activate to sort column ascending">Lời nhắn
                                </th>
                                <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1"
                                    colspan="1" aria-label="Engine version: activate to sort column ascending">Trạng thái
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
                            @if (isset($contact) && count($contact) > 0)
                                @foreach ($contact as $contactData)
                                    <tr class="odd">
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $contactData->Name }}</td>
                                        <td>{{ $contactData->Email }}</td>
                                        <td>{{ $contactData->Phone }}</td>
                                        <td>{{ $contactData->Message }}</td>
                                        <td>{{ $contactData->isRep == 1 ? 'Đã trả lời' : 'Chưa trả lời' }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('admin/contact/edit/' . $contactData->RowID) }}"
                                                title="Chỉnh sửa">
                                                <i class="fa-solid fa-pen-to-square" style="color: #db0b0b;"></i>
                                            </a>
                                            <a href="{{ url('admin/contact/delete/' . $contactData->RowID) }}"
                                                title="Xoá" style="margin-left:3px;" onclick="return confirmDelete();">
                                                <i class="fa-solid fa-trash" style="color: #007dfa;"></i>
                                            </a>
                                            <a href="{{ url('admin/reply/replyContact/' . $contactData->RowID) }}"
                                                style="margin-left: 3px" title="Xoá"
                                                onclick="confirmRep({{ $contactData->RowID }})">
                                                <i class="fa-solid fa-comment-dots"></i>
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
            var result = confirm("Bạn có chắc chắn muốn xóa email này?");
            return result;
        }

        function confirmRep(rowid) {
            var isConfirmed = confirm("Bạn có muốn trả lời liên hệ này không?");

            if (isConfirmed) {
                Rep(rowid);
            }
        }

        function Rep(rowid) {
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/rep',
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
