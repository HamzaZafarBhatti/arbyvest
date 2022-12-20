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
                                <img src="{{asset(auth()->user()->image ? 'asset/user/images/'.auth()->user()->image : 'asset/user/images/avatars/01.png')}}"
                                    class="img-fluid avatar avatar-90 avatar-rounded" alt="img8">
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
                                        <h4 class="counter" style="visibility: visible;">{{ auth()->user()->getUsdWallet }}</h4>
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
                                        <h4 class="counter" style="visibility: visible;">{{ auth()->user()->getGbpWallet }}</h4>
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
                                        <h4 class="counter" style="visibility: visible;">{{ auth()->user()->getNgnWallet }}</h4>
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
                            <div class="card text-center text-md-start">
                                <div class="card-header">
                                    <div class="header-title ">
                                        <h4 class="card-title">Sell Dollars or Pounds on the BLACK MARKET</h4>
                                        <span class="card-subtitle">The Black Market is opened Monday to Friday<br>(You can
                                            sell your USD and GBP now).</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="h5 text-success">Minimum amount: $10/£10</p>
                                    <p class="h5 text-success">Maximum amount: $35000/£35000</p>
                                    <p class="h5 text-success">Enter Amount & Click on "SELL NOW".</p>
                                    <div class="pt-3">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 col-12">
                                                <h3 class="text-warning">YOU SELL</h3>
                                                <div class="input-group mb-3">
                                                    <input type="number" step=".01" min="0.00"
                                                        class="form-control" placeholder="0.00" aria-label="0.00"
                                                        aria-describedby="sell">
                                                    <span class="input-group-text" id="sell">
                                                        <select name="sell_currency" id="sell_currency"
                                                            class="form-select">
                                                            <option value="usd">USD</option>
                                                            <option value="gbp">GBP</option>
                                                        </select>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4 text-center d-none d-md-block">
                                                <svg width="100" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M21.25 16.334V7.665C21.25 4.645 19.111 2.75 16.084 2.75H7.916C4.889 2.75 2.75 4.635 2.75 7.665L2.75 16.334C2.75 19.364 4.889 21.25 7.916 21.25H16.084C19.111 21.25 21.25 19.364 21.25 16.334Z"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path d="M16.0861 12H7.91406" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path d="M12.3223 8.25205L16.0863 12L12.3223 15.748"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <h3 class="text-warning">YOU RECEIVE</h3>
                                                <div class="input-group mb-3">
                                                    <input type="number" step=".01" min="0.00"
                                                        class="form-control" placeholder="0.00" aria-label="0.00"
                                                        aria-describedby="receive">
                                                    <span class="input-group-text p-3" id="receive">
                                                        NGN
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <div class="pt-2">
                                                    <a href="#" class="btn btn-primary" type="button">
                                                        SELL NOW
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="header-title">
                        <h4 class="card-title">Transaction History</h4>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-inline m-0 p-0">
                        <li class="d-flex  align-items-center pt-3">
                            <div class="d-flex justify-content-between rounded-pill">
                                <div class="ms-3 flex-grow-1">
                                    <h6 class="mb-2">+$100 Funded by Transfer from JOHN DOE</h6>
                                    <p class="text-primary mb-2">11/02/21</p>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex  align-items-center pt-3">
                            <div class="d-flex justify-content-between rounded-pill">
                                <div class="ms-3 flex-grow-1">
                                    <h6 class="mb-2">-₦56,990 Sold from Black Market to NGN Wallet</h6>
                                    <p class="text-primary mb-2">11/02/21</p>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex  align-items-center pt-3">
                            <div class="d-flex justify-content-between rounded-pill">
                                <div class="ms-3 flex-grow-1">
                                    <h6 class="mb-2">-₦56,990 Withdrawal successfully from NGN Wallet to Bank Account
                                    </h6>
                                    <p class="text-primary mb-2">11/02/21</p>
                                </div>
                            </div>
                        </li>
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
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
