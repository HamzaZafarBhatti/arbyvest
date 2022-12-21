@extends('user.layout.app')

@section('title', 'Bank Account Details')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="header-title">
                <h3 class="card-title pb-3">Bank Account Wallet</h3>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('user.store_bank_details') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bank_id" class="form-label">Bank Name</label>
                            <select name="bank_id" id="bank_id"
                                class="form-control @if ($errors->get('bank_id')) is-invalid @endif">
                                <option value="">Select Bank</option>
                                @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->get('bank_id'))
                                <div class="invalid-feedback">
                                    @foreach ((array) $errors->get('bank_id')[0] as $message)
                                        {{ $message }}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account_type" class="form-label">Account Type</label>
                            <select name="account_type" id="account_type"
                                class="form-control @if ($errors->get('account_type')) is-invalid @endif">
                                <option value="">Select Account Type</option>
                                <option value="saving">Saving</option>
                                <option value="current">Current</option>
                            </select>
                            @if ($errors->get('account_type'))
                                <div class="invalid-feedback">
                                    @foreach ((array) $errors->get('account_type')[0] as $message)
                                        {{ $message }}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account_name" class="form-label">Account Name</label>
                            <input type="text" class="form-control @if ($errors->get('account_name')) is-invalid @endif"
                                id="account_name" name="account_name">
                            @if ($errors->get('account_name'))
                                <div class="invalid-feedback">
                                    @foreach ((array) $errors->get('account_name')[0] as $message)
                                        {{ $message }}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account_number" class="form-label">Account Number</label>
                            <input type="text" class="form-control @if ($errors->get('account_number')) is-invalid @endif"
                                id="account_number" name="account_number">
                            @if ($errors->get('account_number'))
                                <div class="invalid-feedback">
                                    @foreach ((array) $errors->get('account_number')[0] as $message)
                                        {{ $message }}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="pt-2 text-center text-md-start">
                    <button class="btn btn-primary" type="submit">
                        Add Bank Account Wallet
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
