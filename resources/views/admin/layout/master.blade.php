<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <base href="{{ route('admin.dashboard') }}" />
    <title>@yield('title') | {{ $set->title }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
    <meta name="robots" content="index, follow">
    <meta name="apple-mobile-web-app-title" content="{{ $set->site_name }}" />
    <meta name="application-name" content="{{ $set->site_name }}" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="description" content="{{ $set->site_desc }}" />
    <link rel="shortcut icon" href="{{ asset('asset/images/' . $set->favicon) }}" />
    <link rel="apple-touch-icon" href="{{ asset('asset/images/' . $set->favicon) }}" />
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('asset/images/' . $set->favicon) }}" />
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('asset/images/' . $set->favicon) }}" />
    @include('admin.layout.scripts')
    @yield('css')
</head>

<body class="">
    <!-- Main navbar -->
    @include('admin.layout.navbar')
    <div class="page-content">
        <!-- Main sidebar -->
        @include('admin.layout.sidebar')
        <div class="content-wrapper">
            <div class="page-header page-header-light mb-3">
                <div class="page-header-content header-elements-md-inline">
                    <div class="page-title d-flex">
                        <h4><span class="font-weight-semibold">{{ $set->title }}</span></h4>
                    </div>
                </div>
            </div>
            @include('admin.alert')
            @yield('content')
        </div>
        @yield('script')
</body>

</html>
