@extends('user.layout.app')

@section('title', 'Referral Withdraw')

@section('content')
    @include('user.partials.user_verfication_notice')
    <div class="card">
        <div class="card-header">
            <div class="header-title">
                <h3 class="card-title pb-3">Withdraw Referral Earnings to Bank Account</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="text-center text-md-start">
                <img src="{{ asset('asset/user/images/flags/nigeria.svg') }}" class="img-fluid avatar avatar-70"
                    alt="img60">
                <br class="d-block d-md-none">
                <span class="fs-5 me-2">Refferal Earnings</span>
                <small><a href="#">wallet</a></small>
                <div class="pt-2">
                    <h4 style="visibility: visible;">Refferal Balance</h4>
                    <h4 class="counter" style="visibility: visible;">{{ auth()->user()->getRefNgnWallet }}</h4>
                </div>
            </div>
            <form action="{{ route('user.do_withdraw_referral') }}" method="post">
                @csrf
                <div class="row align-items-center">
                    <div class="form-group">
                        <h3 class="text-warning">AMOUNT TO WITHDRAW</h3>
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
                    <div class="form-group">
                        <h3 class="text-warning">Select BANK Details</h3>
                        <select class="form-select mb-3 @if ($errors->get('bank_user_id')) is-invalid @endif"
                            aria-label="bank_user_id" name="bank_user_id">
                            <option value="">Select Bank Details</option>
                            @if ($user_bank_details)
                                <option value="{{ $user_bank_details->id }}">
                                    {{ $user_bank_details->get_full_account }}</option>
                            @endif
                        </select>
                        @if ($user_bank_details)
                            @include('user.partials.change_bank_details')
                        @endif
                        @if ($errors->get('bank_user_id'))
                            <div class="invalid-feedback">
                                @foreach ((array) $errors->get('bank_user_id')[0] as $message)
                                    {{ $message }}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <h3 class="text-warning">Enter PIN</h3>
                        <input type="text" name="pin"
                            class="form-control @if ($errors->get('pin')) is-invalid @endif" aria-describedby="pin">
                        @include('user.partials.change_pin')
                        @if ($errors->get('pin'))
                            <div class="invalid-feedback">
                                @foreach ((array) $errors->get('pin')[0] as $message)
                                    {{ $message }}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="pt-2">
                        <button class="btn btn-primary" type="submit">
                            Withdraw to BANK
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="header-title">
                <h3 class="card-title pb-3">Withdraw History</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Bank Account</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($withdraws->isNotEmpty())
                            @foreach ($withdraws as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>₦{{ $item->amount }}</td>
                                    <td>{{ auth()->user()->bank->get_full_account }}</td>
                                    <td>{{ $item->get_status }}</td>
                                    <td>{{ date('M d, Y H:i A', strtotime($item->created_at)) }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">No Data Found!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
