@extends('front.template.master')
@section('title', $catName->Name)
@section('description', '')
@section('keywords', '')
@section('url', '')
@section($catName->Alias, 'activeMenu')
@section('description', '')
@section('content')

    <div class="contact_page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12" id="contact_container">
                    <section class="mb-4">
                        <h2 class="h1-responsive font-weight-bold text-center my-4">{!! $catName->Name !!}</h2>
                        <div class="row">
                            <ul class="news_cart_wrap">
                                @if (isset($listNews) && count($listNews) > 0)
                                    @foreach ($listNews as $item)
                                        <li>
                                            <a href="{{ url($item->Alias) }}.html" onclick="updateViews({{$item->RowID}})">
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
                                @endif
                            </ul>

                            @if ($listNews instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                <div class="pagination">
                                    {{ $listNews->links() }}
                                </div>
                            @endif
                        </div>
                    </section>
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
                },
            });
        }
    </script>
@stop
