@extends('user.layout.app')

@section('title', 'Fund Wallet')

@section('css')
    <style>
        .vr {
            width: 2px;
        }

        .text-yellow {
            color: yellow;
        }

        @media (max-width: 430px) {
            .flutterwave-btn {
                font-size: 0.75rem;
                padding: 0.5rem 0.25rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="header-title">
                <h3 class="card-title pb-3">Fund or Buy, Dollars or Pounds on using the ARBITRAGE MARKET RATES</h3>
                <span class="card-subtitle text-primary">You can FUND or BUY USD/GBP by asking any of our TRADERS to transfer
                    you funds or
                    you can fund using Flutterwave</span>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-sm-center gap-sm-5">
                    <h4 class="text-center">
                        <a href="#" class="text-info">
                            MARKET RATES
                        </a>
                    </h4>
                    <span class="vr text-info opacity-100"></span>
                    <h4 class="text-center">
                        <a href="#" class="text-info">
                            CONTACT TRADERS
                        </a>
                    </h4>
                </div>
                <div class="col-6">
                    <div class="text-center">
                        <img src="{{ asset('asset/user/images/flags/usa.svg') }}" class="img-fluid avatar avatar-70"
                            alt="img60">
                        <br class="d-block d-md-none">
                        <span class="fs-5 me-2">US Dollars</span>
                        <br class="d-block d-md-none">
                        <small><a href="#">wallet</a></small>
                        <div class="pt-2">
                            <h4 style="visibility: visible;">USD Balance</h4>
                            <h4 class="counter" style="visibility: visible;">$45,182.23</h4>
                        </div>
                        <div class="pt-2">
                            <a href="#" class="btn btn-primary flutterwave-btn" type="button">
                                Fund USD by Flutterwave
                            </a>
                        </div>
                        <p class="text-info">Instant Funding upon payment confirmation</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-center">
                        <img src="{{ asset('asset/user/images/flags/uk.svg') }}" class="img-fluid avatar avatar-70"
                            alt="img60">
                        <br class="d-block d-md-none">
                        <span class="fs-5 me-2">British Pound</span>
                        <br class="d-block d-md-none">
                        <small><a href="#">wallet</a></small>
                        <div class="pt-2">
                            <h4 style="visibility: visible;">GBP Balance</h4>
                            <h4 class="counter" style="visibility: visible;">£56,938.33</h4>
                        </div>
                        <div class="pt-2">
                            <a href="#" class="btn btn-primary flutterwave-btn" type="button">
                                Fund USD by Flutterwave
                            </a>
                        </div>
                        <p class="text-info">Instant Funding upon payment confirmation</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr size="5px" class="opacity-100">
                </div>
                <div class="col-md-12">
                    <h4 class="text-primary">
                        Fund US Dollar/British Pounds wallet by contacting our TRADERS
                        <br>
                        Send them your ACCOUNT ID: <span class="text-yellow">5277062992DSD31</span> To Transfer Funds to you
                        using Arbitrage market rate.
                        <br>
                        <a href="#" class="text-info text-uppercase"><u>contact traders to fund us doollars/british
                                pounds</u></a>
                    </h4>
                </div>
            </div>
        </div>
    </div>
@endsection
