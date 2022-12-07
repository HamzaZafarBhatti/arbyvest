@extends('admin.layouts.master')
@section('title')
    @lang('translation.Dashboards')
@endsection
@section('css')
    <link href="{{ URL::asset('/user_assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    @component('admin.components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title1')
            Good Evening ! <span class="text-capitalize">{{ auth()->user()->username }}</span>
        @endslot
        @slot('title2')
            Welcome!
        @endslot
    @endcomponent
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/user_assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/user_assets/libs/admin-resources/admin-resources.min.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ URL::asset('/user_assets/js/pages/dashboard.init.js') }}"></script>
    <script src="{{ URL::asset('/user_assets/js/app.min.js') }}"></script>
@endsection
