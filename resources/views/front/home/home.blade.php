@extends('front.template.master')
@section('title', 'Trang chủ')
@section('description', '')
@section('keywords', '')
@section('url', '')
@section('/', 'activeMenu')
@section('description', '')
@section('content')

    <div class="home_page">
        <div class="home_page-slider">
            <div class="container">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        @foreach ($slider as $key => $item)
                            <div class="item {{ $key === 0 ? 'active' : '' }}">
                                <img src="/resources/images/sliders/{{ $item->Images }}" style="width:100%;">
                            </div>
                        @endforeach
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="home_top row">
                        <div class="col-md-8 home_top-left">
                            <div class="heading">Bài viết mới nhất</div>
                            <ul class="list-unstyled row">
                                @if (isset($news) && count($news) > 0)
                                    @foreach ($news as $new)
                                        <li class="col-sm-6 col-md-4 home_top-left-item">
                                            <a href="{{ $new->Alias }}.html" title="{{ $new->Name }}"
                                                onclick="updateViews({{ $new->RowID }})">
                                                <div style="overflow: hidden">
                                                    <div class="home_top-left-img"
                                                        style="background-image: url('{{ url('resources/images/news/' . $new->Images) }}');">
                                                    </div>
                                                </div>
                                                <p>{{ $new->Name }}</p>
                                                <b>{{ \Illuminate\Support\Str::limit($new->SmallDescription, 80) . '...' }}</b>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="col-md-4 home_top-right">
                            <div class="heading">Admin</div>
                            <div class="home_top-right-container">
                                <div class="home_top-right-img"
                                    style="background-image: url('{{ '/resources/images/about/about.jpeg' }}');"></div>
                                <b>Bufi Vawn Ys</b>
                                <p>Chúng tôi tạo ra trang web này để giới thiệu và hỗ trợ các bạn sửa lỗi trong các vấn đề
                                    lỗi
                                    máy tính hiện nay. Rất mong sự ủng hộ và đóng góp của các bạn.
                                    <a href="{{ url('ve-chung-toi') }}" title="Xem thêm">[read more]</a>
                                </p>
                                <div class="home_social">
                                    @if (isset($social) && $social != null)
                                        @foreach ($social as $item)
                                            <a href="{{ $item->Alias }}"
                                                title="{{ $item->Name }}">{!! $item->Font !!}</a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="row">
                <div class="col-md-12 home_center">
                    <div class="heading" style="margin-top: 20px">Lỗi phần cứng mới nhất</div>
                    <ul class="row">
                        @if (isset($newsHard) && count($newsHard) > 0)
                            @foreach ($newsHard as $newHard)
                                <li class="col-md-3 col-sm-6 home_center-item">
                                    <a href="{{ $newHard->Alias }}.html" title="{{ $newHard->Name }}"
                                        onclick="updateViews({{ $newHard->RowID }})">
                                        <div style="overflow: hidden">
                                            <div class="home_center-item-image"
                                                style="background-image: url('{{ url('resources/images/news/' . $newHard->Images) }}');">
                                            </div>
                                        </div>
                                        <p>{{ $newHard->Name }}</p>
                                        <b>{{ \Illuminate\Support\Str::limit($newHard->SmallDescription, 100) . '...' }}</b>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 home_center home_bottom">
                    <div class="heading" style="margin-top: 20px">Lỗi phần mềm mới nhất</div>
                    <ul class="row">
                        @if (isset($newsSoft) && count($newsSoft) > 0)
                            @foreach ($newsSoft as $newSoft)
                                <li class="col-md-3 col-sm-6 home_center-item">
                                    <a href="{{ $newSoft->Alias }}.html" title="{{ $newSoft->Name }}" onclick="updateViews({{ $newSoft->RowID }})">
                                        <div style="overflow: hidden">
                                            <div class="home_center-item-image"
                                                style="background-image: url('{{ url('resources/images/news/' . $newSoft->Images) }}');">
                                            </div>
                                        </div>
                                        <p>{{ $newSoft->Name }}</p>
                                        <b>{{ \Illuminate\Support\Str::limit($newSoft->SmallDescription, 100) . '...' }}</b>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 home_center home_bottom">
                <div class="heading" style="margin-top: 20px">Thủ thuật mới nhất</div>
                <ul class="row">
                    @if (isset($newsTip) && count($newsTip) > 0)
                        @foreach ($newsTip as $newTip)
                            <li class="col-md-3 col-sm-6 home_center-item">
                                <a href="{{ $newTip->Alias }}.html" title="{{ $newTip->Name }}" onclick="updateViews({{ $newTip->RowID }})">
                                    <div style="overflow: hidden">
                                        <div class="home_center-item-image"
                                            style="background-image: url('{{ url('resources/images/news/' . $newTip->Images) }}');">
                                        </div>
                                    </div>
                                    <p>{{ $newTip->Name }}</p>
                                    <b>{{ \Illuminate\Support\Str::limit($newTip->SmallDescription, 100) . '...' }}</b>
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
    <script>
        function updateViews(rowid) {
            var token = $('#_token').val();
            $.ajax({
                url: 'update-view',
                type: 'POST',
                data: {
                    RowID: rowid,
                    _token: token
                }
            });
        }
    </script>
@stop
