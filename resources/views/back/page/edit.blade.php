@extends('back.template.master')

@section('title', 'Quản lí trang')

@section('heading', 'Sửa thông tin trang')

@section('page', 'active')

@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="row">
            <div class="card card-primary col-md-12 mx-auto" style="padding: 0">
                <!-- form start -->
                <form action="{{ url('admin/page/edit') }}/{{ $page->RowID }}" method="POST">
                    <div class="card-header" style="background-color: #007bff;">
                        <a href="{{ url('admin/page/list') }}" class="btn btn-block btn-light text-dark"
                            title="Quay lại"style="max-width: 100px; float: right; font-weight: 500 ">Quay
                            lại</a>
                    </div>
                    <div class="card-body">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên trang<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ $page->Name }}" id="title" onkeyup="ChangeToSlug()">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Đường dẫn<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="Alias" id="slug" value="{{ $page->Alias }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Font</label>
                            <input type="text" class="form-control" name="font" value="{{ $page->Font }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Trạng thái</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="statusOpen" name="status"
                                    value="1"{{ $page->Status == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusOpen">Bật</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="statusLocked" name="status"
                                    value="0" {{ $page->Status == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusLocked">Tắt</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Sắp xếp <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="sort" value="{{ $page->Sort }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thẻ meta title</label>
                            <textarea class="form-control" name="MetaTitle" rows="2">{{ $page->MetaTitle }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thẻ meta description</label>
                            <textarea class="form-control" name="MetaDescription" rows="4">{{ $page->MetaDescription }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thẻ meta keyword</label>
                            <textarea class="form-control" name="MetaKeyword" rows="2">{{ $page->MetaKeyword }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả tin tức<span class="text-danger">*</span></label>
                            <textarea class="form-control" name="Description" id="ckeditor" rows="6">{{ $page->Description }}</textarea>
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
