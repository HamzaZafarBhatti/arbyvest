<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title') | {{ $set->site_name }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    {{-- <meta content="" name="keywords"> --}}
    <meta content="{{ $set->site_desc }}" name="description">

    <!-- Favicon -->
    <link href="{{ asset('asset/images/' . $set->favicon) }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="{{ asset('asset/front/css/css2.css') }}" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="{{asset('asset/front/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('asset/front/css/bootstrap-icons.css')}}" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('asset/front/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/front/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('asset/front/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('asset/front/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->

    @include('front.layout.navbar')

    @yield('content')

    @include('front.layout.footer')

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="{{ asset('asset/front/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{ asset('asset/front/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('asset/front/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('asset/front/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('asset/front/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('asset/front/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('asset/front/lib/counterup/counterup.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('asset/front/js/main.js') }}"></script>
</body>

</html>
