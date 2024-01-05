@extends('back.template.master')

@section('title', 'Quản lí thông tin liên hệ')

@section('heading', 'Sửa thông tin thông tin liên hệ')

@section('contact_info', 'active')

@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="row">
            <div class="card card-primary col-md-12 mx-auto" style="padding: 0">
                <!-- form start -->
                <form action="{{ url('admin/contact_info/edit') }}/{{ $contact_info->RowID }}" method="POST">
                    <div class="card-header" style="background-color: #007bff;">
                        <a href="{{ url('admin/contact_info/list') }}" class="btn btn-block btn-light text-dark"
                            title="Quay lại"style="max-width: 100px; float: right; font-weight: 500 ">Quay
                            lại</a>
                    </div>
                    <div class="card-body">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="Name" value="{{ $contact_info->Name }}" id="title" onkeyup="ChangeToSlug()">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Font</label>
                            <input type="text" class="form-control" name="Font" value="{{ $contact_info->Font }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Trạng thái</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="statusOpen" name="Status"
                                    value="1"{{ $contact_info->Status == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusOpen">Bật</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="statusLocked" name="Status"
                                    value="0" {{ $contact_info->Status == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusLocked">Tắt</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="Description" value="{{ $contact_info->Description }}">
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
