@extends('user.layout.app')

@section('title', 'Verify Trader')

@section('css')
    <style>
        .verified ul {
            list-style-type: none;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="header-title">
                <h3 class="card-title pb-3">Verify Trader (Vendor) Details</h3>
            </div>
        </div>
        <div class="card-body">
            @if (!isset($verification_result))
                @include('user.partials.trader_verify_form')
            @else
                <div class="traderVerificationResult">
                    @if (isset($is_verified) && $is_verified)
                        @include('user.partials.trader_verified')
                    @else
                        @include('user.partials.trader_unverified')                
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
