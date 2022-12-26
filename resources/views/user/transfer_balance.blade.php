@extends('user.layout.app')

@section('title', 'Transfer Balance')

@section('content')
    @include('user.partials.user_verfication_notice')
    <div class="card">
        <div class="card-header">
            <div class="header-title">
                <h3 class="card-title pb-3">TRANSFER Dollars or Pounds to another user</h3>
                <span class="card-subtitle">
                    Only APPROVED VENDORS (TRADERS) by admin can be able to transfer US Dollars or British Pounds to users
                </span>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('user.do_transfer_balance') }}" method="post">
                @csrf
                <p class="h5 text-success">Minimum Transfer Amount: $10/£10</p>
                <p class="h5 text-success">Enter Amount & Click on "TRANSFER NOW".</p>
                <div class="row align-items-center">
                    <div class="col-md-4 col-12 pt-3">
                        <div class="form-group">
                            <h3 class="text-warning">AMOUNT TO TRANSFER</h3>
                            <input type="number" name="amount" step=".01" min="0.00"
                                class="form-control @if ($errors->get('amount')) is-invalid @endif" placeholder="0.00"
                                aria-label="0.00" aria-describedby="amount">
                            @if ($errors->get('amount'))
                                <div class="invalid-feedback">
                                    @foreach ((array) $errors->get('amount')[0] as $message)
                                        {{ $message }}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4 col-12 pt-3">
                        <h3 class="text-warning">SELECT CURRENCY</h3>
                        <div class="form-check @if ($errors->get('currency')) is-invalid @endif">
                            <input type="radio" class="form-check-input" name="currency" id="usd" value="usd">
                            <label for="usd" class="form-check-label pl-2">US Dollars
                                ({{ auth()->user()->get_usd_wallet }})</label>
                        </div>
                        <div class="form-check @if ($errors->get('currency')) is-invalid @endif">
                            <input type="radio" class="form-check-input" name="currency" id="gbp" value="gbp">
                            <label for="gbp" class="form-check-label pl-2">British Pounds
                                ({{ auth()->user()->get_gbp_wallet }})</label>
                        </div>
                        @if ($errors->get('currency'))
                            <div class="invalid-feedback">
                                @foreach ((array) $errors->get('currency')[0] as $message)
                                    {{ $message }}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4 col-12 pt-3">
                        <div class="form-group">
                            <h3 class="text-warning">RECIPIENT ACCOUNT ID</h3>
                            <input type="text" name="account_id"
                                class="form-control @if ($errors->get('account_id')) is-invalid @endif"
                                aria-describedby="account_id">
                            @if ($errors->get('account_id'))
                                <div class="invalid-feedback">
                                    @foreach ((array) $errors->get('account_id')[0] as $message)
                                        {{ $message }}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 col-12 pt-3">
                        <div class="form-group">
                            <h3 class="text-warning">PIN</h3>
                            <input type="text" name="pin"
                                class="form-control @if ($errors->get('pin')) is-invalid @endif"
                                aria-describedby="pin">
                            @include('user.partials.change_pin')
                            @if ($errors->get('pin'))
                                <div class="invalid-feedback">
                                    @foreach ((array) $errors->get('pin')[0] as $message)
                                        {{ $message }}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="pt-2">
                            <button class="btn btn-primary" type="submit">
                                TRANSFER NOW
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
