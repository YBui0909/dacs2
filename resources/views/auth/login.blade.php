<!DOCTYPE html>
<html>

<head>
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="/resources/css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-dark mt-5">Đăng nhập</h2>
                <div class="card my-5">

                    <form class="card-body cardbody-color p-lg-5" action="{{ url('admin/login') }}" method="POST">
                        {!! csrf_field() !!}
                        <div class="text-center">
                            <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png"
                                class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px"
                                alt="profile">
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" name="username" id="Username" aria-describedby="emailHelp"
                                placeholder="Tên đăng nhập">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu">
                        </div>
                        <div class="text-center"><button type="submit"
                            class="btn btn-color btn-primary px-5 mb-5 w-100">Đăng
                                nhập</button></div>

                        @if (session('notice'))
                            <div class="alert alert-danger text-center">
                                {{ session('notice') }}
                            </div>
                        @endif
                    </form>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
