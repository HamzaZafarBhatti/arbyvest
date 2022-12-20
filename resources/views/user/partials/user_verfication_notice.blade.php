@if (auth()->user()->is_verified)
    <div class="col-lg-12">
        <div class="card text-center text-md-start">
            <div class="row">
                <div class="col-md-9 col-12">
                    <div class="card-header">
                        <div class="header-title ">
                            <h4 class="card-title text-success">Your Account is FULLY VERIFIED</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6>
                            You can trade on the Black Market and Withdraw without Limits on this
                            account.
                        </h6>
                    </div>
                </div>
                <div class="col-md-3 col-12 text-center">
                    <img src="{{ asset('asset/user/images/utilities/05.png') }}" class="img-fluid avatar avatar-120"
                        alt="img60">
                </div>
            </div>
        </div>
    </div>
@else
    <div class="col-lg-12">
        <div class="card text-center text-md-start">
            <div class="card-header">
                <div class="header-title ">
                    <h4 class="card-title text-danger">Please Complete your Account Verification</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9 col-12">
                        <h6>
                            You won't be able to trade on the Black Market or Withdraw without
                            completing your KYC verification.
                        </h6>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="pt-2">
                            <a href="#" class="btn btn-primary w-100" type="button">
                                Complete Verification
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
