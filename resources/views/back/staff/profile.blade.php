@extends('back.template.master')

@section('title', 'Thông tin tài khoản')

@section('heading', 'Thông tin tài khoản')

@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="row">
            <div class="card card-primary col-md-6 mx-auto" style="padding: 0">
                <!-- form start -->
                <form action="profile" method="POST">
                    <div class="card-body">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="fullname" value="{{ Auth::user()->fullname }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" value="{{ Auth::user()->address }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tài khoản</label>
                            <input type="text" class="form-control" name="username" value="{{ Auth::user()->username }}"
                                @disabled(true)>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mật khẩu</label>
                            <input type="password" class="form-control" name="password">
                            <p class="text-danger ad_note_password">Để trống trường này nếu không muốn thay đổi mật khẩu.
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
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
