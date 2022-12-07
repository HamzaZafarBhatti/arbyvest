<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Admin Login | Arbyvest</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
    <meta name="robots" content="index, follow">
    <meta name="apple-mobile-web-app-title" content="arbyvest" />
    <meta name="application-name" content="arbyvest" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid, illo?" />
    <link rel="shortcut icon" href="{{ asset('asset/images/favicon.jpg') }}" />
    <link rel="apple-touch-icon" href="{{ asset('asset/images/favicon.jpg') }}" />
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('asset/images/favicon.jpg') }}" />
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('asset/images/favicon.jpg') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,600,700&display=swap">
    <link rel="stylesheet" href="{{ asset('asset/admin/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('asset/admin/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}"
        type="text/css">
    <link rel="stylesheet" href="{{ asset('asset/admin/css/argon.css?v=1.1.0') }}" type="text/css">
    @yield('css')
</head>

<body class="bg-dark">
    <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('asset/images/logo.png') }}" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse"
                aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="{{ route('admin.dashboard') }}">
                                <img src="{{ asset('asset/images/logo.png') }}">
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <!-- Header -->
        <div class="header py-7 py-lg-8 pt-lg-9">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <h1 class="text-white">Login</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="border-0 mb-0">
                        <div class="card-header bg-transparent pb-5">
                            <div class="text-white text-center mt-2 mb-3">Sign in with credentials</div>
                        </div>
                        @include('admin.alert')
                        <div class="card-body px-lg-5 py-lg-5">
                            <form role="form" action="{{ route('admin.do_login') }}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-dark"><i
                                                    class="ni ni-circle-08"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Username" type="text"
                                            name="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-dark"><i
                                                    class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Password" type="password"
                                            name="password">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-default my-4">LOGIN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="py-5" id="footer-main">
        <div class="container">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-xl-6">
                    <div class="copyright text-center text-xl-left text-muted">
                        <a href="{{ url('/') }}" class="font-weight-bold ml-1"><span
                                class="text-yellow">Arbyvest</span></a> &copy; {{ date('Y') }}. All
                        Rights Reserved.
                    </div>
                </div>
                <div class="col-xl-6">
                    <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('asset/admin/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/admin/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asset/admin/vendor/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('asset/admin/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('asset/admin/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
    <script src="{{ asset('asset/admin/js/argon.js?v=1.1.0') }}"></script>
    <script src="{{ asset('asset/admin/js/demo.min.js') }}"></script>
    @yield('script')
</body>

</html>
