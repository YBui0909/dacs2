@extends('back.template.master')

@section('title', 'Cấu hình hệ thống')

@section('heading', 'Cấu hình hệ thống')

@section('system','active');
@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="row">
            <div class="card card-primary col-md-12  mx-auto" style="padding: 0">
                <!-- form start -->
                <form action="{{ url('admin/system') }}" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên công ty <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ $name->Description }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Logo</label>
                            <img src="/resources/images/logo/{{ $logo->Description }}" alt="Logo" style="max-width: 30px">
                            <input type="file" class="form-control col-md-4" name="logo">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Favicon</label>
                            <img src="/resources/images/favicon/{{ $favicon->Description }}" alt="Favicon" style="max-width: 30px">
                            <input type="file" class="form-control col-md-4" name="favicon">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" value="{{ $email->Description }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" value="{{ $phone->Description }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" value="{{ $address->Description }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Copyright</label>
                            <input type="text" class="form-control" name="copyright"
                                value="{{ $copyright->Description }}">
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" style="float: right">Chỉnh sửa</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>
@stop
