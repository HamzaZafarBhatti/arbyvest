@extends('admin.layout.master')

@section('title', 'Admin Settings')

@section('css')
    <style>
        .image-container {
            border: 1px solid #ccc;
            padding: 10px 20px;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Congifure website</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.settings.update') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Company / website name:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="site_name" maxlength="200" value="{{ $set->site_name }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Website title:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="title" max-length="200" value="{{ $set->title }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Company email:</label>
                                <div class="col-lg-10">
                                    <input type="email" name="email" value="{{ $set->email }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Mobile:</label>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <input type="text" name="mobile" max-length="14" value="{{ $set->mobile }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Short description:</label>
                                <div class="col-lg-10">
                                    <textarea type="text" name="site_desc" rows="4" class="form-control">{{ $set->site_desc }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Address:</label>
                                <div class="col-lg-10">
                                    <textarea type="text" name="address" rows="4" class="form-control">{{ $set->address }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Withdraw Fee:</label>
                                <div class="col-lg-10">
                                    <input type="number" name="withdraw_fee" value="{{ $set->withdraw_fee }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Min Withdrawal:</label>
                                <div class="col-lg-10">
                                    <input type="number" name="min_withdrawal" value="{{ $set->min_withdrawal }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Max Withdrawal:</label>
                                <div class="col-lg-10">
                                    <input type="number" name="max_withdrawal" value="{{ $set->max_withdrawal }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">USD Black Market Counter (Hours):</label>
                                <div class="col-lg-10">
                                    <input type="number" name="usd_black_market_counter" value="{{ $set->usd_black_market_counter }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">GBP Black Market Counter (Hours):</label>
                                <div class="col-lg-10">
                                    <input type="number" name="gbp_black_market_counter" value="{{ $set->gbp_black_market_counter }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Referral Bonus for USD (%):</label>
                                <div class="col-lg-10">
                                    <input type="number" name="usd_referral_bonus" value="{{ $set->usd_referral_bonus }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Referral Bonus for GBP (%):</label>
                                <div class="col-lg-10">
                                    <input type="number" name="gbp_referral_bonus" value="{{ $set->gbp_referral_bonus }}" class="form-control">
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn bg-dark">Submit<i
                                        class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Configure Logo and Favicon</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.settings.update_logo_favicon') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Website Logo:</label>
                                <div class="col-lg-10">
                                    <input type="file" name="logo" class="form-control">
                                </div>
                            </div>
                            <div class="image-container">
                                <img class="w-100" src="{{ asset('asset/images/'.$set->logo) }}">
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Website Favicon:</label>
                                <div class="col-lg-10">
                                    <input type="file" name="favicon" class="form-control">
                                </div>
                            </div>
                            <div class="image-container">
                                <img class="w-100" src="{{ asset('asset/images/'.$set->favicon) }}">
                            </div>
                            <div class="text-right mt-3">
                                <button type="submit" class="btn bg-dark">Submit<i
                                        class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
