@extends('front.template.master')
@section('title', 'Liên hệ')
@section('description', '')
@section('keywords', '')
@section('url', '')
@section('lien-he', 'activeMenu')
@section('description', '')
@section('content')

    <div class="contact_page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12" id="contact_container">
                    <section class="mb-4">
                        <h2 class="h1-responsive font-weight-bold text-center my-4">LIÊN HỆ CHÚNG TÔI</h2>
                        <p class="text-center w-responsive mx-auto mb-5">Bạn có câu hỏi nào không? Xin vui lòng liên hệ trực
                            tiếp với chúng tôi. Nhóm của chúng tôi sẽ quay lại với bạn trong vòng vài giờ để giúp bạn.</p>
                        <div class="row">
                            <div class="col-md-9 mb-md-0 mb-5">
                                <form id="contact-form" name="contact-form" method="dialog">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="md-form mb-0">
                                                <input type="text" id="name" name="name" class="form-control">
                                                <label for="name" class="">Tên của bạn</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="md-form mb-0">
                                                <input type="text" id="email" name="email" class="form-control">
                                                <label for="email" class="">Email của bạn</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="md-form mb-0">
                                                <input type="text" id="subject" name="subject" class="form-control">
                                                <label for="subject" class="">Chủ đề</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="md-form mb-0">
                                                <input type="text" id="phone" name="phone" class="form-control">
                                                <label for="subject" class="">Số điện thoại của bạn</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="md-form">
                                                <textarea type="text" id="message" name="message" rows="10" class="form-control md-textarea"></textarea>
                                                <label for="message">Nội dung</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center text-md-left">
                                        <button class="btn btn-primary sendContact" onclick="sendMessage()"
                                            id="btnSendMessage">GỬI</button>
                                    </div>
                                </form>
                                <div class="status"></div>
                            </div>
                            <div class="col-md-3 text-center">
                                <ul class="list-unstyled mb-0">
                                    @if (isset($contactInfo) && count($contactInfo) > 0)
                                        @foreach ($contactInfo as $item)
                                            <li>
                                                {!! $item->Font !!}
                                                <p>{!! $item->Description !!}</p>
                                            </li>
                                        @endforeach
                                    @endif                                   
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@stop
