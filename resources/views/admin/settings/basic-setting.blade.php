@extends('admin.master')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Congifure website</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.settings.update', $set->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Company / website name:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="site_name" maxlength="200" value="{{ $set->site_name }}"
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
                                <label class="col-form-label col-lg-2">Website title:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="title" max-length="200" value="{{ $set->title }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Balance on signup:</label>
                                <div class="col-lg-10">
                                    <input type="number" name="balance_reg" step="any" max-length="10"
                                        value="{{ convertFloat($set->balance_reg) }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Upgrade fee <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="number" name="upgrade_fee" step="any" max-length="10"
                                        value="{{ $set->upgrade_fee }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">MLM Plan Registration fee <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="number" name="mlm_plan_reg_fee" step="any" max-length="10"
                                        value="{{ $set->mlm_plan_reg_fee }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Video Earning Plan fee <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="number" name="video_earn_plan_reg_fee" step="any" max-length="10"
                                        value="{{ $set->video_earn_plan_reg_fee }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Video Premimum Earning Plan fee <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="number" name="video_premium_plan_reg_fee" step="any" max-length="10"
                                        value="{{ $set->video_premium_plan_reg_fee }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Status <span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <div class="form-check form-check-inline form-check-switchery">
                                        <label class="form-check-label">
                                            @if ($set->email_verification == 1)
                                                <input type="checkbox" name="email_verification"
                                                    class="form-check-input-switchery" value="1" checked>
                                            @else
                                                <input type="checkbox" name="email_verification"
                                                    class="form-check-input-switchery" value="1">
                                            @endif
                                            Email verification
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline form-check-switchery">
                                        <label class="form-check-label">
                                            @if ($set->referral == 1)
                                                <input type="checkbox" name="referral"
                                                    class="form-check-input-switchery" value="1" checked>
                                            @else
                                                <input type="checkbox" name="referral"
                                                    class="form-check-input-switchery" value="1">
                                            @endif
                                            Referral
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline form-check-switchery">
                                        <label class="form-check-label">
                                            @if ($set->sms_verification == 1)
                                                <input type="checkbox" name="sms_verification"
                                                    class="form-check-input-switchery" value="1" checked>
                                            @else
                                                <input type="checkbox" name="sms_verification"
                                                    class="form-check-input-switchery" value="1">
                                            @endif
                                            SMS Verification
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline form-check-switchery">
                                        <label class="form-check-label">
                                            @if ($set->email_notify == 1)
                                                <input type="checkbox" name="email_notify"
                                                    class="form-check-input-switchery" value="1" checked>
                                            @else
                                                <input type="checkbox" name="email_notify"
                                                    class="form-check-input-switchery" value="1">
                                            @endif
                                            Email notify
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline form-check-switchery">
                                        <label class="form-check-label">
                                            @if ($set->sms_notify == 1)
                                                <input type="checkbox" name="sms_notify" class="form-check-input-switchery"
                                                    value="1" checked>
                                            @else
                                                <input type="checkbox" name="sms_notify" class="form-check-input-switchery"
                                                    value="1">
                                            @endif
                                            SMS notify
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline form-check-switchery">
                                        <label class="form-check-label">
                                            @if ($set->registration == 1)
                                                <input type="checkbox" name="registration"
                                                    class="form-check-input-switchery" value="1" checked>
                                            @else
                                                <input type="checkbox" name="registration"
                                                    class="form-check-input-switchery" value="1">
                                            @endif
                                            Registration
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline form-check-switchery">
                                        <label class="form-check-label">
                                            @if ($set->upgrade_status == 1)
                                                <input type="checkbox" name="upgrade_status"
                                                    class="form-check-input-switchery" value="1" checked>
                                            @else
                                                <input type="checkbox" name="upgrade_status"
                                                    class="form-check-input-switchery" value="1">
                                            @endif
                                            Upgrade status
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Affliate YOUTUBE LINK:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="affiliate_yt_link"
                                        value="{{ $set->affiliate_yt_link }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Affliate User SIGNUP Balance</label>
                                <div class="col-lg-10">
                                    <input type="text" name="balance_reg_affiliate"
                                        value="{{ $set->balance_reg_affiliate }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Premium User SIGNUP Balance</label>
                                <div class="col-lg-10">
                                    <input type="text" name="balance_reg_premium"
                                        value="{{ $set->balance_reg_premium }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">MLM User SIGNUP Balance</label>
                                <div class="col-lg-10">
                                    <input type="number" name="balance_reg_mlm"
                                        value="{{ $set->balance_reg_mlm }}" class="form-control">
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
                            <div class="text-right">
                                <button type="submit" class="btn bg-dark">Submit<i
                                        class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @stop
