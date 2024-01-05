@extends('front.template.master')
@section('title', 'Tìm kiếm')
@section('description', '')
@section('keywords', '')
@section('url', '')
@section('description', '')
@section('content')

    <div class="contact_page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12" id="contact_container">
                    <section class="mb-4">
                        <h2 class="h1-responsive font-weight-bold text-center my-4">TÌM KIẾM</h2>
                        <div class="row">
                            <ul class="news_cart_wrap">
                                @if (isset($searchList) && count($searchList) > 0)
                                    @foreach ($searchList as $item)
                                        <li>
                                            <a href="{{ url($item->Alias) }}.html">
                                                <img src="{{ url('/resources/images/news/' . $item->Images) }}"
                                                    alt="{{ $item->Name }}">
                                                <div class="text-container">
                                                    <b>{{ $item->Name }}</b>
                                                    <p>{{ \Illuminate\Support\Str::limit($item->SmallDescription, 100) . '...' }}
                                                    </p>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <h1 style="display: block; width: 100%;" class="text-center">Không tìm thấy kết quả nào phù hợp!</h1>
                                @endif
                            </ul>

                            @if ($searchList instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                <div class="pagination">
                                    {{ $searchList->links() }}
                                </div>
                            @endif
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@stop
