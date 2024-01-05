@extends('front.template.master')
@section('title', $newsName)
@section('description', '')
@section('keywords', '')
@section('url', '')
@section('description', '')
@section('content')

    <div class="contact_page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12" id="contact_container">
                    @if (isset($detailNews))
                        <section class="mb-4">
                            <h2 class="h1-responsive font-weight-bold text-center my-4">{{ $detailNews->Name }}</h2>
                            <div class="row">
                                <div class="col-md-12">
                                    {!! $detailNews->Description !!}
                                </div>
                            </div>
                        </section>
                    @endif
                </div>
            </div>
            <div class="row">
                @include('front.comments.comments')
            </div>
        </div>
    </div>
@stop
