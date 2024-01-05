@extends('back.template.master')

@section('title', 'Quản lí bài viết')

@section('heading', 'Thêm bài viết')

@section('news', 'active');

@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="row">
            <div class="card card-primary col-md-12" style="padding: 0">
                <!-- form start -->
                <form id="" action="{{ url('/admin/news/add') }}" method="POST" enctype="multipart/form-data">
                    <div class="card-header" style="background-color: #007bff;">
                        <a href="{{ url('admin/news/list') }}" class="btn btn-block btn-light text-dark"
                            title="Quay lại"style="max-width: 100px; float: right; font-weight: 500 ">Quay
                            lại</a>
                    </div>
                    <div class="card-body">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên tin tức<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="Name" onkeyup="ChangeToSlug()"
                                id="title">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Đường dẫn<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="Alias" id="slug">
                        </div>
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select class="form-control" name="CategoryName">
                                @if (isset($category) && count($category) > 0)
                                    @foreach ($category as $item)
                                        <option value="{{ $item->RowID }}">
                                            {{ $item->Name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <input type="file" class="form-control col-md-4" name="Images">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Trạng thái</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="statusOpen" name="Status" value="1"
                                    checked>
                                <label class="form-check-label" for="statusOpen">Bật</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="statusLocked" name="Status"
                                    value="0">
                                <label class="form-check-label" for="statusLocked">Tắt</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thẻ meta title</label>
                            <textarea class="form-control" name="MetaTitle" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thẻ meta description</label>
                            <textarea class="form-control" name="MetaDescription" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thẻ meta keyword</label>
                            <textarea class="form-control" name="MetaKeyword" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giới thiệu ngắn</label>
                            <textarea class="form-control" name="SmallDescription" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả tin tức<span class="text-danger">*</span></label>
                            <textarea class="form-control" name="Description" rows="6" id="ckeditor"></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer" style="width: 100%">
                        <button type="submit" class="btn btn-primary" style="float: right">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>
@stop
