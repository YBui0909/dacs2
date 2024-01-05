@extends('back.template.master')

@section('title', 'Quản lí liên hệ')

@section('heading', 'Sửa thông liên hệ')

@section('contact', 'active')

@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="row">
            <div class="card card-primary col-md-6 mx-auto" style="padding: 0">
                <!-- form start -->
                <form action="{{ url('admin/contact/edit') }}/{{ $contact->RowID }}" method="POST">
                    <div class="card-header" style="background-color: #007bff;">
                        <a href="{{ url('admin/contact/list') }}" class="btn btn-block btn-light text-dark"
                            title="Quay lại"style="max-width: 100px; float: right; font-weight: 500 ">Quay
                            lại</a>
                    </div>
                    <div class="card-body">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ $contact->Name }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" value="{{ $contact->Email }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" value="{{ $contact->Phone }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Lời nhắn<span class="text-danger">*</span></label>
                            <textarea rows="7" type="text" class="form-control" name="message">{{ $contact->Message }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Trạng thái</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="statusOpen" name="status"
                                    value="1"{{ $contact->isViews == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusOpen">Đã xem</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="statusLocked" name="status"
                                    value="0" {{ $contact->isViews == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusLocked">Chưa xem</label>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer" style="width: 100%">
                        <button type="submit" class="btn btn-primary" style="float: right">Thay đổi</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- /.card -->
    </div>
@stop
