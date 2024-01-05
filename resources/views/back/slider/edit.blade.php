@extends('back.template.master')

@section('title', 'Quản lí slideshow')

@section('heading', 'Sửa slideshow')

@section('slider', 'active')

@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="row">
            <div class="card card-primary col-md-12 mx-auto" style="padding: 0">
                <!-- form start -->
                <form action="{{ url('admin/slider/edit') }}/{{ $slider->RowID }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="card-header" style="background-color: #007bff;">
                        <a href="{{ url('admin/slider/list') }}" class="btn btn-block btn-light text-dark"
                            title="Quay lại"style="max-width: 100px; float: right; font-weight: 500 ">Quay
                            lại</a>
                    </div>
                    <div class="card-body">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên slideshow<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="Name" value="{{ $slider->Name }}"
                                id="title" onkeyup="ChangeToSlug()">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            @if ($slider->Images != null)
                                <img src="/resources/images/sliders/{{ $slider->Images }}" alt="Hình ảnh" style="max-height: 100px;"> 
                            @endif
                            <input type="file" class="form-control col-md-6" name="Images"
                                value="{{ $slider->Images }}" {{ $slider->Images }}>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Trạng thái</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="statusOpen" name="Status" value="1"
                                    {{ $slider->Status == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusOpen">Bật</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="statusLocked" name="Status"
                                    value="0" {{ $slider->Status == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusLocked">Tắt</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Sắp xếp<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="Sort" value="{{$slider->Sort}}">
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
