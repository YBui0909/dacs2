<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/public/admin/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" >
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/public/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/public/admin/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/public/admin/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/public/admin/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/public/admin/plugins/summernote/summernote-bs4.min.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="/resources/css/custom.css">
    <!-- Ckeditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/super-build/ckeditor.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="/public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/public/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ '/' }}" class="nav-link" target="_blank">Xem website</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        Quản lý
                        {{-- <span class="badge badge-warning navbar-badge">15</span> --}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">Quản lý</span>
                        @if (Auth::user()->level == 1)
                            <div class="dropdown-divider"></div>
                            <a href="{{ url('admin/staff/list') }}" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> Quản lý nhân viên
                            </a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <a href="{{ url('admin/staff/profile') }}" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> Thông tin tài khoản
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ url('logout') }}" class="dropdown-item">
                            <i class="fa-solid fa-right-from-bracket"></i> Thoát
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" role="button">
                        <i class="fa-solid fa-user"></i>
                        Xin chào <b>{{ Auth::user()->fullname }}</b>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('admin/home') }}" class="brand-link">
                <img src="/public/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin Control</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if (Auth::user()->level == 1)
                            <li class="nav-item menu-open">
                                <a href="{{ url('admin/system') }}" class="nav-link @yield('system')">
                                    <i class="fa-solid fa-gear fa-fw"></i>
                                    <p>
                                        Cấu hình hệ thống
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item menu-open">
                                <a href="{{ url('admin/page/list') }}" class="nav-link @yield('page')">
                                    <i class="fa-solid fa-sitemap"></i>
                                    <p>
                                        Quản lý trang
                                    </p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="#" class="nav-link @yield('news') @yield('news_cat')">
                                <i class="fa-solid fa-newspaper"></i>
                                <p>
                                    Quản lý bài viết
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                                <li class="nav-item">
                                    <a href="{{ url('admin/news_cat/list') }}" class="nav-link">
                                        ★ Danh mục bài viết
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/news/list') }}" class="nav-link">
                                        ★ Danh sách bài viết
                                    </a>
                                </li>
                            </ul>
                        </li>

                        @if (Auth::user()->level == 1)
                            <li class="nav-item menu-open">
                                <a href="{{ url('admin/slider/list') }}" class="nav-link @yield('slider')">
                                    <i class="fa-solid fa-sliders"></i>
                                    <p>
                                        Quản lý slideshow
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item menu-open">
                                <a href="{{ url('admin/social/list') }}" class="nav-link @yield('social')">
                                    <i class="fa-solid fa-square-share-nodes"></i>
                                    <p>
                                        Quản lý mạng xã hội
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item menu-open">
                                <a href="{{ url('admin/contact_info/list') }}" class="nav-link @yield('contact_info')">
                                    <i class="fa-solid fa-envelope fa-fw"></i>
                                    <p>
                                        Quản lý thông tin liên hệ
                                    </p>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item menu-open">
                            <a href="{{ url('admin/newsletter/list') }}" class="nav-link @yield('newsletter')">
                                <i class="fas fa-gift"></i>
                                <p>
                                    Quản lý nhận tin mới
                                </p>
                            </a>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="{{ url('admin/contact/list') }}" class="nav-link @yield('contact')">
                                <i class="fa-solid fa-envelope fa-fw"></i>
                                <p>
                                    Quản lý liên hệ
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 class="m-0">@yield('heading')</h1>
                            {{-- @if (Session::has('flash_message'))
                                <div class="ad_message alert alert-{!! Session::get('flash_level') !!}">
                                    {!! Session::get('flash_level') !!}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif --}}
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <section class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            {{-- @if (Session::has('flash_message'))
                                <div class="ad_message alert alert-{!! Session::get('flash_level') !!} text-center">
                                    {!! Session::get('flash_message') !!}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                            @endif --}}
                        </div>
                    </div>
                    <!-- Main content -->
                    @yield('content')
                    <!-- /.content -->
                </div>
            </section>

        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }} <a href="">DACS2</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="/public/admin/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/public/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="/public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="/public/admin/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="/public/admin/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="/public/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="/public/admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="/public/admin/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="/public/admin/plugins/moment/moment.min.js"></script>
    <script src="/public/admin/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="/public/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="/public/admin/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="/public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/public/admin/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="/public/admin/dist/js/pages/dashboard.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="/public/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/public/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/public/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/public/admin/plugins/jszip/jszip.min.js"></script>
    <script src="/public/admin/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/public/admin/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/public/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/public/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/public/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- Ckeditor -->
    <script>
        CKEDITOR.ClassicEditor.create(document.getElementById("ckeditor"), {
            toolbar: {
                items: [
                    'exportPDF', 'exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript',
                    'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed',
                    '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    }
                ]
            },
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            fontSize: {
                options: [10, 12, 14, 'default', 18, 20, 22],
                supportAllValues: true
            },
            htmlSupport: {
                allow: [{
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }]
            },
            htmlEmbed: {
                showPreviews: true
            },
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            mention: {
                feeds: [{
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                        '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                        '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                        '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }]
            },
            removePlugins: [
                'AIAssistant',
                'CKBox',
                'CKFinder',
                'EasyImage',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                'MathType',
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents',
                'PasteFromOfficeEnhanced'
            ]
        });
    </script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        function ChangeToSlug() {
            var title, slug;

            //Lấy text từ thẻ input title
            title = document.getElementById("title").value;

            //Đổi chữ hoa thành chữ thường
            slug = title.toLowerCase();

            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('slug').value = slug;
        };
    </script>
</body>

</html>
