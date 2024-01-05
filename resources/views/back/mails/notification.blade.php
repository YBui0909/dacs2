<!-- resources/views/emails/notification.blade.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .mail-image {
            background-size: cover;
            background-position: center;
            height: 160px;
            transition: transform 0.2s ease;
        }

        .mail-image:hover {
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <h1 class="col-md-12 text-center">Thông báo tin mới nhất</h1>
            <div class="col-md-12 content">
                <h2>{!! $news->Name !!}</h2>
                <img src="https://th.bing.com/th/id/OIP.ygC544udWRiUXEUx2htI1gHaGq?rs=1&pid=ImgDetMain" alt="{{ $news->Name }}">
                <p>{!! $news->SmallDescription !!}</p>
                <a class="btn btn-primary" href="{{ url($news->Alias) }}.html">Truy cập bài viết</a>
            </div>
        </div>
    </div>
</body>

</html>
