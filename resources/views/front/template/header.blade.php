<div class="header">
    <div class="header_top">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="header_logo">
                        <a href="/" title="Trang chủ">
                            <img src="/resources/images/logo/{{ $logo->Description }}" alt="Logo"
                                style="width: auto; height: 88px;">
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="header_social">
                        @if (isset($social) && $social != null)
                            @foreach ($social as $item)
                                <a href="{{ $item->Alias }}" title="{{ $item->Name }}">{!! $item->Font !!}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header_bottom">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-8">
                    <div class="header_menu">
                        <ul>
                            @if (isset($page) && count($page) > 0)
                                @foreach ($page as $item)
                                    <li>
                                        @if ($item->Alias == '/')
                                            <a href="{{ $item->Alias }}" title="{{ $item->Name }}"
                                                class="@yield($item->Alias)">{!! $item->Font !!}</a>
                                        @else
                                            <a href="{{ $item->Alias }}" title="{{ $item->Name }}"
                                                class="@yield($item->Alias)">{{ $item->Name }}</a>
                                        @endif
                                    </li>
                                @endforeach
                                @foreach ($cat as $item)
                                    <li>
                                        <a href="{{ $item->Alias }}" title="{{ $item->Name }}"
                                            class="@yield($item->Alias)">{{ $item->Name }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="header_search">
                        <form action="{{ url('tim-kiem') }}" method="GET" class="header_search" id="searchForm">
                            <input type="text" id="btn-Search" placeholder="Nhập từ khoá tìm kiếm" name="keyword">
                            <button>
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const btnSearch = document.getElementById("btn-Search");
        const form = document.getElementById("searchForm");

        form.addEventListener("submit", function(event) {
            if (btnSearch.value === "") {
                event.preventDefault();
                alert("Vui lòng nhập từ khóa tìm kiếm!");
            }
        });
    </script>
</div>
