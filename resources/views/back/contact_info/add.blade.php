@extends('back.template.master')

@section('title', 'Quản lí trang')

@section('heading', 'Thêm trang')

@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="row">
            <div class="card card-primary col-md-6  mx-auto" style="padding: 0">
                <!-- form start -->
                <form action="add" method="POST">
                    <div class="card-header" style="background-color: #007bff;">
                        <a href="{{ url('admin/page/list') }}" class="btn btn-block btn-light text-dark"
                            title="Quay lại"style="max-width: 100px; float: right; font-weight: 500 ">Quay
                            lại</a>
                    </div>
                    <div class="card-body">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên liên hệ<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Font</label>
                            <input type="text" class="form-control" name="font">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Trạng thái</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="statusOpen" name="status" value="1"
                                    checked>
                                <label class="form-check-label" for="statusOpen">Bật</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="statusLocked" name="status"
                                    value="0">
                                <label class="form-check-label" for="statusLocked">Tắt</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Sắp xếp <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="sort" value="">
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" style="float: right">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>
@stop
