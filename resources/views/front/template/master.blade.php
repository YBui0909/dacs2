<!DOCTYPE html>
<html lang="vi">

<head>
    <!-- google ads -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noodp, index, follow">
    <meta name="revisit-after" content="1 days">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <link rel="shortcut icon" type="image/x-icon" href="/resources/images/favicon/{{$favicon->Description}}">
    <link rel="canonical" href="@yield('url')">
    <meta property="og:locale" itemprop="inLanguage" content="vi_VN">
    <meta property="og:url" content="@yield('url')">
    <meta property="og:type" content="article">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:image" content="@yield('images')">
    <meta property="og:site_name" content="Website hỗ trợ sửa chữa máy tính">
    <meta name="copyright" content="Website hỗ trợ sửa chữa máy tính">
    <meta name="author" content="Website hỗ trợ sửa chữa máy tính">
    <meta name="geo.placename" content="Ho Chi Minh, Viet Nam">
    <meta name="geo.region" content="VN-HCM">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="/resources/js/front.js"></script>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('resources/css/style.css') }}">
</head>

<body class="home page-template-default page page-id-7">
    <input type="hidden" id="_token" value="{{ csrf_token() }}">
    <div id="wrapper">
        @include('front.template.header')
        <div class="content">
            @yield('content')
        </div>
        @include('front.template.footer');
    </div>

</body>

</html>
