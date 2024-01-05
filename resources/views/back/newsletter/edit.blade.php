@extends('back.template.master')

@section('title', 'Quản lí nhận tin khuyến mãi')

@section('heading', 'Sửa thông tin nhận tin khuyến mãi')

@section('newsletter', 'active')

@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="row">
            <div class="card card-primary col-md-6 mx-auto" style="padding: 0">
                <!-- form start -->
                <form action="{{ url('admin/newsletter/edit') }}/{{ $newsletter->RowID }}" method="POST">
                    <div class="card-header" style="background-color: #007bff;">
                        <a href="{{ url('admin/newsletter/list') }}" class="btn btn-block btn-light text-dark"
                            title="Quay lại"style="max-width: 100px; float: right; font-weight: 500 ">Quay
                            lại</a>
                    </div>
                    <div class="card-body">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="name" value="{{ $newsletter->Email }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Trạng thái</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="statusOpen" name="status"
                                    value="1"{{ $newsletter->isViews == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusOpen">Bật</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="statusLocked" name="status"
                                    value="0" {{ $newsletter->isViews == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusLocked">Tắt</label>
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
