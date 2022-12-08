<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login | {{ $set->title }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('asset/images/' . $set->favicon) }}" />
    <link rel="stylesheet" href="{{ asset('asset/user/css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/user/css/coinex.css?v=1.0.0') }}">
</head>

<body class="" data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    <!-- loader END -->
    <div style="background-image: url('{{ asset('asset/user/images/auth/01.png') }}')">
        <div class="wrapper">
            <section class="vh-100 bg-image">
                <div class="container h-100">
                    <div class="row justify-content-center h-100 align-items-center">
                        <div class="col-md-6 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="auth-form">
                                        <h2 class="text-center mb-4">Sign In</h2>
                                        <form method="POST" action="{{ route('user.do_login') }}">
                                            @csrf
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="name@example.com" value="{{ old('email') }}" required autocomplete="false">
                                                <label for="email">Email</label>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input type="password" name="password" class="form-control" id="password"
                                                    placeholder="Password" required autocomplete="false">
                                                <label for="password">Password</label>
                                            </div>
                                            <div class="d-flex justify-content-between  align-items-center flex-wrap">
                                                <div class="form-group">
                                                    <a href="#page-forgot-password.html">Forgot Password?</a>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Sign In</button>
                                            </div>
                                            {{-- @include('user.auth.social_login') --}}
                                        </form>
                                        <div class="new-account mt-3 text-center">
                                            <p>Don't have an account? <a class=""
                                                    href="{{ route('user.register') }}">Click
                                                    here to sign up</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('asset/user/js/libs.min.js') }}"></script>
    <!-- widgetchart JavaScript -->
    <script src="{{ asset('asset/user/js/charts/widgetcharts.js') }}"></script>
    <!-- fslightbox JavaScript -->
    <script src="{{ asset('asset/user/js/fslightbox.js') }}"></script>
    <!-- app JavaScript -->
    <script src="{{ asset('asset/user/js/app.js') }}"></script>
    <!-- apexchart JavaScript -->
    <script src="{{ asset('asset/user/js/charts/apexcharts.js') }}"></script>
</body>

</html>
