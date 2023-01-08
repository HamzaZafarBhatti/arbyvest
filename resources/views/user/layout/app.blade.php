<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ $set->title }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('asset/images/' . $set->favicon) }}" />
    <link rel="stylesheet" href="{{ asset('asset/user/css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/user/css/coinex.css?v=1.0.0') }}">
    <style>
        #svg_arrow {
            max-width: 100px;
            width: 100%;
        }
        .nav-link {
            white-space: unset !important;
        }
    </style>
    @yield('css')
</head>

<body class=" ">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    <!-- loader END -->
    @include('user.layout.sidebar')

    <main class="main-content">
        <div class="position-relative">
            @include('user.layout.navbar')
        </div>
        <div class="container-fluid content-inner pb-0">
            @include('user.alert')
            @yield('content')
        </div>
        @include('user.layout.footer')
    </main>

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

    <script src="{{ asset('asset/admin/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
    <script>
        if ("{{ $user_proof }}" == 1) {
            swal({
                    title: "Upload Your Payment PROOF!",
                    text: "✨CONGRATULATIONS ON YOUR LATEST CASHOUT. ✨",
                    icon: "success",
                    buttons: true,
                    dangerMode: false,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = "{{ route('user.upload_proof') }}"
                    }
                });
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('script')
</body>

</html>
