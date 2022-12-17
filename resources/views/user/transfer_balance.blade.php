@extends('user.layout.app')

@section('title', 'Transfer Balance')

@section('css')
@endsection

@section('content')
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
                        <h3 class="text-warning">AMOUNT TO TRANSFER</h3>
                        <input type="number" name="amount" step=".01" min="0.00" class="form-control"
                            placeholder="0.00" aria-label="0.00" aria-describedby="amount">
                    </div>
                    <div class="col-md-4 col-12 pt-3">
                        <h3 class="text-warning">SELECT CURRENCY</h3>
                        <label>
                            <input type="radio" name="currency" id="usd" value="usd">
                            US DOllars (${{ auth()->user()->usd_wallet }})
                        </label>
                        <br>
                        <label>
                            <input type="radio" name="currency" id="gbp" value="gbp">
                            British Pounds (£{{ auth()->user()->gbp_wallet }})
                        </label>
                    </div>
                    <div class="col-md-4 col-12 pt-3">
                        <h3 class="text-warning">RECIPIENT ACCOUNT ID</h3>
                        <input type="text" name="account_id" class="form-control" aria-describedby="account_id">
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
