@extends('front.layout.master')

@section('title', 'Market Rates')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-4 animated slideInDown">Market Rates</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Market Rates</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="display-5 mb-5">Market Rates</h1>
            </div>
            <table class="table table-borderless">
                <thead class="table-light">
                    <tr>
                        <th scope="col">CURRENCY</th>
                        <th scope="col">ARBYVEST RATE</th>
                        <th scope="col">BLACK MARKET RATE</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$market_prices->isEmpty())
                        @foreach ($market_prices as $item)
                            <tr>
                                <td scope="row">{{ $item->currency }}</td>
                                <td>{{ $item->get_local_rate }}</td>
                                <td>{{ $item->get_black_market_rate }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">No Market Price found!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <!-- Team End -->
@endsection
