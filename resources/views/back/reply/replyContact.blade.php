@extends('back.template.master')

@section('title', 'Quản lí liên hệ')

@section('heading', 'Trả lời liên hệ')

@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="row">
            <div class="card card-primary col-md-12  mx-auto" style="padding: 0">
                <!-- form start -->
                <form action="{{url('admin/reply/replyContact/'.$contact->RowID)}}" method="POST">
                    <div class="card-header" style="background-color: #007bff;">
                        <a href="{{ url('admin/contact/list') }}" class="btn btn-block btn-light text-dark"
                            title="Quay lại"style="max-width: 100px; float: right; font-weight: 500 ">Quay
                            lại</a>
                    </div>
                    <div class="card-body">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên liên hệ <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{$contact->Name}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" class="form-control" name="Email" value="{{$contact->Email}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="text" class="form-control" name="font" value="{{$contact->Phone}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Chủ đề</label>
                            <input type="text" class="form-control" name="font" value="{{$contact->Subject}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nội dung liên hệ</label>
                            <textarea class="form-control" name="font" rows="4">{!!$contact->Message!!}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Trả lời</label>
                            <textarea class="form-control" name="replyContent" rows="6" id="ckeditor"></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" style="float: right">Trả lời</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>
@stop
