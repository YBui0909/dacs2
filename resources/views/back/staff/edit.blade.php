@extends('back.template.master')

@section('title', 'Quản lí nhân viên')

@section('heading', 'Sửa thông tin nhân viên')

@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="row">
            <div class="card card-primary col-md-6 mx-auto" style="padding: 0">
                <!-- form start -->
                <form action="{{ url('admin/staff/edit') }}/{{ $user->id }}" method="POST">
                    <div class="card-body">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="fullname" value="{{ $user->fullname }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                        </div>
                        <div class="form-group">
                            <label>Chức vụ</label>
                            <select class="form-control" name="level">
                                @if (isset($userLevel) && count($userLevel) > 0)
                                    @foreach ($userLevel as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $user->level || old('level') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" value="{{ $user->address }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Trạng thái</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="statusOpen" name="status"
                                    value="1"{{ $user->status == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusOpen">Mở</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="statusLocked" name="status"
                                    value="0" {{ $user->status == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusLocked">Khoá</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tài khoản <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="username" value="{{ $user->username }}"
                                @disabled(true)>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mật khẩu <span class="text-danger">*</span></label>
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

                    <div class="card-footer" style="width: 100%">
                        <button type="submit" class="btn btn-primary" style="float: right">Thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>
@stop
