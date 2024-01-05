@extends('front.template.master')
@section('title', 'Liên hệ')
@section('description', '')
@section('keywords', '')
@section('url', '')
@section('ve-chung-toi', 'activeMenu')
@section('description', '')
@section('content')

    <div class="contact_page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12" id="contact_container">
                    <section class="mb-4">
                        <h2 class="h1-responsive font-weight-bold text-center my-4">VỀ CHÚNG TÔI</h2>
                        <div class="row">
                            <div class="col-md-12">
                                @if (isset($pageInfo))
                                    {!! $pageInfo->Description !!}
                                @endif
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@stop
