@extends('user.layout.app')

@section('title', 'Dashboard')

@section('css')
    <style>
        select.form-select {
            -webkit-appearance: menulist !important;
            -moz-appearance: menulist !important;
            -ms-appearance: menulist !important;
            -o-appearance: menulist !important;
            appearance: menulist !important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row align-items-center mb-4">
                <div class="col-12 col-lg-6">
                    <div class="card mb-xl-0">
                        <div class="card-body ">
                            <div class="d-flex flex-column align-items-center flex-md-row gap-3">
                                <img src="{{ asset(auth()->user()->image ? auth()->user()->get_user_image : 'asset/user/images/avatars/01.png') }}"
                                    class="img-fluid avatar avatar-90 avatar-rounded" alt="img8"
                                    style="object-fit: cover">
                                <div class="d-flex flex-column justify-content-evenly text-center text-md-start">
                                    <span class="h5">
                                        Welcome, {{ auth()->user()->name }}!
                                    </span>
                                    <span class="text-primary">
                                        Account ID: <span class="text-uppercase">{{ auth()->user()->account_id }}</span>
                                    </span>
                                    <span class="text-white">
                                        Account Verification Status:
                                        @if (auth()->user()->is_verified)
                                            <span class="text-uppercase text-success">verified</span>
                                        @else
                                            <span class="text-uppercase text-danger">unverified</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card shining-card">
                                <div class="card-body text-center text-md-start">
                                    <img src="{{ asset('asset/user/images/flags/usa.svg') }}"
                                        class="img-fluid avatar avatar-70" alt="img60">
                                    <br class="d-block d-md-none">
                                    <span class="fs-5 me-2">US Dollars</span>
                                    <small><a href="#">wallet</a></small>
                                    <div class="pt-2">
                                        <h4 style="visibility: visible;">USD Balance</h4>
                                        <h4 class="counter" style="visibility: visible;">{{ auth()->user()->getUsdWallet }}
                                        </h4>
                                    </div>
                                    <div class="pt-2">
                                        <a href="#" class="btn btn-primary w-100" type="button">
                                            Buy US Dollars
                                        </a>
                                    </div>
                                    <div class="pt-2">
                                        <a href="#" class="btn btn-primary w-100" type="button">
                                            Sell to Black Market
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card shining-card">
                                <div class="card-body text-center text-md-start">
                                    <img src="{{ asset('asset/user/images/flags/uk.svg') }}"
                                        class="img-fluid avatar avatar-70" alt="img60">
                                    <br class="d-block d-md-none">
                                    <span class="fs-5 me-2">British Pound</span>
                                    <small><a href="#">wallet</a></small>
                                    <div class="pt-2">
                                        <h4 style="visibility: visible;">GBP Balance</h4>
                                        <h4 class="counter" style="visibility: visible;">{{ auth()->user()->getGbpWallet }}
                                        </h4>
                                    </div>
                                    <div class="pt-2">
                                        <a href="#" class="btn btn-primary w-100" type="button">
                                            Buy GB Dollars
                                        </a>
                                    </div>
                                    <div class="pt-2">
                                        <a href="#" class="btn btn-primary w-100" type="button">
                                            Sell to Black Market
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card shining-card">
                                <div class="card-body text-center text-md-start">
                                    <img src="{{ asset('asset/user/images/flags/nigeria.svg') }}"
                                        class="img-fluid avatar avatar-70" alt="img60">
                                    <br class="d-block d-md-none">
                                    <span class="fs-5 me-2">Nigerian Naira</span>
                                    <small><a href="#">wallet</a></small>
                                    <div class="pt-2">
                                        <h4 style="visibility: visible;">NGN Balance</h4>
                                        <h4 class="counter" style="visibility: visible;">{{ auth()->user()->getNgnWallet }}
                                        </h4>
                                    </div>
                                    <div class="pt-2">
                                        <a href="#" class="btn btn-primary w-100" type="button">
                                            Withdraw to Bank
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('user.partials.user_verfication_notice')
                        <div class="col-lg-12">
                            @include('user.partials.blackmarket_form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="header-title">
                        <h4 class="card-title">Transfer Balance Logs</h4>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-inline m-0 p-0">
                        @if (count($transfer_logs) > 0)
                            @foreach ($transfer_logs as $item)
                                <li class="d-flex  align-items-center pt-3">
                                    <div class="d-flex justify-content-between rounded-pill">
                                        <div class="ms-3 flex-grow-1">
                                            <h6
                                                class="mb-2 {{ $item->vendor_account_id == $user_account_id ? 'text-danger' : 'text-success' }}">
                                                {{ $item->get_amount }} Transfer
                                                {{ ($item->vendor_account_id == $user_account_id ? 'to '. ($item->user->name ?? 'N/A') : 'from '. ($item->vendor->name ?? 'N/A'))  }}
                                            </h6>
                                            <p class="text-primary mb-2">{{ date('M d, Y', strtotime($item->created_at)) }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li class="d-flex  align-items-center pt-3">
                                No Record Found
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="header-title">
                        <h4 class="card-title">Black Market Sell Logs</h4>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-inline m-0 p-0">
                        @if (count($blackmarket_logs) > 0)
                            @foreach ($blackmarket_logs as $item)
                                <li class="d-flex  align-items-center pt-3">
                                    <div class="d-flex justify-content-between rounded-pill">
                                        <div class="ms-3 flex-grow-1">
                                            <h6 class="mb-2">-<span class="text-uppercase">{{$item->get_amount_sold}}</span> Sold from Black Market to NGN Wallet</h6>
                                            <p class="text-primary mb-2">{{ date('M d, Y', strtotime($item->updated_at)) }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li class="d-flex  align-items-center pt-3">
                                No Record Found
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="header-title">
                        <h4 class="card-title">Withdrawal Logs</h4>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-inline m-0 p-0">
                        @if (count($withdraws) > 0)
                            @foreach ($withdraws as $item)
                                <li class="d-flex  align-items-center pt-3">
                                    <div class="d-flex justify-content-between rounded-pill">
                                        <div class="ms-3 flex-grow-1">

                                            <h6 class="mb-2">-{{$item->get_amount}} Withdrawal {{ $item->get_status }} from NGN Wallet to Bank Account
                                            </h6>
                                            <p class="text-primary mb-2">11/02/21</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li class="d-flex  align-items-center pt-3">
                                No Record Found
                            </li>
                        @endif
                        {{-- 
                        <li class="d-flex  align-items-center pt-3">
                            <div class="d-flex justify-content-between rounded-pill">
                                <div class="ms-3 flex-grow-1">
                                    <h6 class="mb-2">-₦56,990 Withdrawal DECLINED from NGN Wallet to Bank Account</h6>
                                    <p class="text-primary mb-2">11/02/21</p>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex  align-items-center pt-3">
                            <div class="d-flex justify-content-between rounded-pill">
                                <div class="ms-3 flex-grow-1">
                                    <h6 class="mb-2">-₦56,990 Withdrawal PENDING from NGN Wallet to Bank Account</h6>
                                    <p class="text-primary mb-2">11/02/21</p>
                                </div>
                            </div>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('asset/user/js/blackmarket.js') }}"></script>
@endsection
