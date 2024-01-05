@extends('back.template.master')

@section('title', 'Quản lí tin tức')

@section('heading', 'Sửa tin tức')

@section('news', 'active')

@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="row">
            <div class="card card-primary col-md-12 mx-auto" style="padding: 0">
                <!-- form start -->
                <form action="{{ url('admin/news/edit') }}/{{ $news->RowID }}" method="POST" enctype="multipart/form-data">
                    <div class="card-header" style="background-color: #007bff;">
                        <a href="{{ url('admin/news/list') }}" class="btn btn-block btn-light text-dark"
                            title="Quay lại"style="max-width: 100px; float: right; font-weight: 500 ">Quay
                            lại</a>
                    </div>
                    <div class="card-body">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên tin tức<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="Name" value="{{ $news->Name }}" id="title" onkeyup="ChangeToSlug()">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Đường dẫn<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="Alias" id="slug" value="{{ $news->Alias }}">
                        </div>
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select class="form-control" name="CategoryName">
                                @if (isset($category) && count($category) > 0)
                                    @foreach ($category as $item)
                                        <option value="{{ $item->RowID }}"
                                            {{ $item->RowID == $news->RowIDCat ? 'selected' : '' }}>
                                            {{ $item->Name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            @if ($news->Images != null)
                                <img src="/resources/images/news/{{ $news->Images }}" alt="Hình ảnh">
                            @endif
                            <input type="file" class="form-control col-md-6" name="Images" value="{{ $news->Images }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Trạng thái</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="statusOpen" name="Status" value="1"
                                    {{ $news->Status == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusOpen">Bật</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="statusLocked" name="Status"
                                    value="0" {{ $news->Status == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusLocked">Tắt</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thẻ meta title</label>
                            <textarea class="form-control" name="MetaTitle" rows="2">{{ $news->MetaTitle }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thẻ meta description</label>
                            <textarea class="form-control" name="MetaDescription" rows="4">{{ $news->MetaDescription }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thẻ meta keyword</label>
                            <textarea class="form-control" name="MetaKeyword" rows="2">{{ $news->MetaKeyword }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giới thiệu ngắn</label>
                            <textarea class="form-control" name="SmallDescription" rows="4">{{ $news->SmallDescription }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả tin tức<span class="text-danger">*</span></label>
                            <textarea class="form-control" name="Description" id="ckeditor" rows="6">{{ $news->Description }}</textarea>
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
