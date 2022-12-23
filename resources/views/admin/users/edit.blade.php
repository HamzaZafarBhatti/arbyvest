@extends('admin.layout.master')

@section('title', 'User Account')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">
                            Update account information
                        </h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.users.update', $user->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Username:</label>
                                <div class="col-lg-10">
                                    <input type="" hidden value="{{ $user->id }}" name="id">
                                    <input type="text" name="username" class="form-control"
                                        value="{{ $user->username }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Name:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Email:</label>
                                <div class="col-lg-10">
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Mobile:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="mobile" class="form-control" value="{{ $user->phone }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Country:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="country" class="form-control"
                                        value="{{ $user->country }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">City:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="city" class="form-control" value="{{ $user->city }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Zip code:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="zip_code" class="form-control"
                                        value="{{ $user->zip_code }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Address:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="address" class="form-control"
                                        value="{{ $user->address }}">
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn bg-dark">Update<i
                                        class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Update Bank details</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.users.update_bank_details') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Bank Name:</label>
                                <div class="col-lg-10">
                                    <select name="bank_id" id="bank_id" class="form-control">
                                        <option value="">Select Bank Name</option>
                                        @if ($banks)
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}"
                                                    {{ $user->bank_id == $bank->id ? 'selected' : '' }}>
                                                    {{ $bank['name'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <input type="" hidden value="{{ $user->id }}" name="id">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Account Name:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="account_name" class="form-control" id="account_name"
                                        value="{{ $user->bank_account_name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Account Number:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="account_no" class="form-control" id="account_no"
                                        value="{{ $user->bank_account_no }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Account Type:</label>
                                <div class="col-lg-10">
                                    <select name="account_type" id="account_type" class="form-control">
                                        <option value="">Select Account Type</option>
                                        <option value="savings"
                                            {{ $user->bank_account_type == 'savings' ? 'selected' : '' }}>Savings</option>
                                        <option value="current"
                                            {{ $user->bank_account_type == 'current' ? 'selected' : '' }}>Current</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn bg-dark">Update<i
                                        class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div> --}}
            </div>
            <div class="col-md-4">
                {{-- <div class="card">
                    <div class="card-body text-center">
                        <div class="card-img-actions d-inline-block mb-3">
                            <img class="img-fluid rounded-circle"
                                src="{{ url('/') }}/asset/images/{{ $user->photo }}" width="120" height="120"
                                alt="">
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                            <div>
                                <ul class="list list-unstyled mb-0">
                                    <li>Joined: <span
                                            class="font-weight-semibold">{{ date('Y/m/d h:i:A', strtotime($user->created_at)) }}</span>
                                    </li>
                                    <li>Last Login: <span
                                            class="font-weight-semibold">{{ date('Y/m/d h:i:A', strtotime($user->last_login)) }}</span>
                                    </li>
                                    <li>Last Updated: <span
                                            class="font-weight-semibold">{{ date('Y/m/d h:i:A', strtotime($user->updated_at)) }}</span>
                                    </li>
                                    <li>IP Address: <span class="font-weight-semibold">{{ $user->ip_address }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Update user pin</h6>
                    </div>
                    <div class="card-body">
                        <div>
                            <ul class="list list-unstyled mb-0">
                                <li>Joined: <span
                                        class="font-weight-semibold">{{ date('Y/m/d h:i:A', strtotime($user->created_at)) }}</span>
                                </li>
                                {{-- <li>Last Login: <span
                                        class="font-weight-semibold">{{ date('Y/m/d h:i:A', strtotime($user->last_login)) }}</span>
                                </li> --}}
                                <li>Last Updated: <span
                                        class="font-weight-semibold">{{ date('Y/m/d h:i:A', strtotime($user->updated_at)) }}</span>
                                </li>
                                {{-- <li>IP Address: <span class="font-weight-semibold">{{ $user->ip_address }}</span>
                                </li> --}}
                                <li>Document Type: <span
                                    class="font-weight-semibold">{{ $user->document_type ? $user->document_type->name : 'Not Selected' }}</span>
                                </li>
                                <li>Document:
                                    <span>
                                        @if(!$ext)
                                            <p>No Verfication Document Uploaded</p>
                                        @else
                                            @if ($ext == 'pdf')
                                                <a href="{{ $user_document_url }}" target="_blank">View Document</a>
                                            @else
                                                <img src="{{ $user_document_url }}" width="100%">
                                            @endif
                                        @endif
                                    </span>
                                </li>
                                <li>Selfie:
                                    <span>
                                        @if ($user->selfie)
                                            <img src="{{ asset($user->get_user_selfie) }}" width="100%">
                                        @else
                                            <p>No Selfie Uploaded</p>
                                        @endif
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <form action="{{ route('admin.users.verify_account') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $user->id }}" name="user_id">
                            <div class="text-right mt-3">
                                <button type="submit" class="btn bg-dark">Verify User</button>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Update user pin</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.users.profile-update-pin') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Pin:</label>
                                <div class="col-lg-10">
                                    <input type="" hidden value="{{ $user->id }}" name="id">
                                    <input type="text" name="pin" class="form-control">
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn bg-dark">Update<i
                                        class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Withdraw logs</h6>
                    </div>
                    <div class="">
                        <table class="table datatable-show-all">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Facebook Profile Link</th>
                                    <th>Amount</th>
                                    <th>Details</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($withdraw as $k => $val)
                                    <tr>
                                        <td>{{ ++$k }}.</td>
                                        <td>{{ $val->user->fb_url }}</td>
                                        <td>{{ substr($val->amount, 0, 9) }}</td>
                                        <td>{{ $val->account_no }}</td>
                                        <td><span class="badge badge-success">
                                            @if ($val->type == 1)
                                                VIDEO EARNINGS
                                            @elseif($val->type == 2)
                                                MLM Balance
                                            @elseif($val->type == 3)
                                                Referral Balance
                                            @endif
                                        </span></td>
                                        <td>
                                            @if ($val->status == 0)
                                                <span class="badge badge-danger">Unpaid</span>
                                            @elseif($val->status == 1)
                                                <span class="badge badge-success">Paid</span>
                                            @elseif($val->status == 2)
                                                <span class="badge badge-info">Declined</span>
                                            @endif
                                        </td>
                                        <td>{{ date('Y/m/d h:i:A', strtotime($val->created_at)) }}</td>
                                        <td>{{ date('Y/m/d h:i:A', strtotime($val->updated_at)) }}</td>
                                        <td class="text-center">
                                            <div class="list-icons">
                                                <div class="dropdown">
                                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                        <i class="icon-menu9"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <!--@if ($val->status == 0)-->
                                                        <!--    <a class='dropdown-item'-->
                                                        <!--        href="{{ route('admin.withdraw_approve', $val->id) }}"><i-->
                                                        <!--            class="icon-thumbs-up3 mr-2"></i>Approve request</a>-->
                                                        <!--    <a class='dropdown-item'-->
                                                        <!--        href="{{ route('admin.withdraw_decline', $val->id) }}"><i-->
                                                        <!--            class="icon-thumbs-down3 mr-2"></i>Decline request</a>-->
                                                        <!--@endif-->
                                                        <a data-toggle="modal" data-target="#{{ $val->id }}delete"
                                                            class="dropdown-item"><i class="icon-bin2 mr-2"></i>Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <div id="{{ $val->id }}delete" class="modal fade" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <h6 class="font-weight-semibold">Are you sure you want to delete this?
                                                    </h6>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link"
                                                        data-dismiss="modal">Close</button>
                                                        <a href="{{ route('admin.withdraw_delete', $val->id) }}"
                                                            class="btn bg-danger">Proceed</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Affiliate Profits</h6>
                    </div>
                    <div class="">
                        <table class="table datatable-show-all">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>profit</th>
                                    <th>Details</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($profit as $k => $val)
                                    <tr>
                                        <td>{{ ++$k }}.</td>
                                        <td>{{ substr($val->profit, 0, 9) }}</td>
                                        <td>{{ $val->trx }}</td>
                                        <td>{{ date('Y/m/d h:i:A', strtotime($val->start_datetime)) }}</td>
                                        <td>{{ date('Y/m/d h:i:A', strtotime($val->end_datetime)) }}</td>
                                        <td>
                                            @if ($val->status == 0)
                                                <span class="badge badge-warning">In progress</span>
                                            @else
                                                <span class="badge badge-success">Completed</span>
                                            @endif
                                        </td>
                                        <td>{{ date('Y/m/d h:i:A', strtotime($val->created_at)) }}</td>
                                        <td>{{ date('Y/m/d h:i:A', strtotime($val->updated_at)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Direct Referrals</h6>
                    </div>
                    <div class="">
                        <table class="table datatable-show-all">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($referral as $k => $val)
                                    <tr>
                                        <td>{{ ++$k }}.</td>
                                        <td>{{ $val->referral->name ?? 'N/A' }}</td>
                                        <td>{{ $val->referral->username ?? 'N/A' }}</td>
                                        <td>{{ date('Y/m/d', strtotime($val->created_at)) }}</td>
                                        <td>{{ date('Y/m/d h:i:A', strtotime($val->updated_at)) }}</td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Indirect Referrals</h6>
                    </div>
                    <div class="">
                        <table class="table datatable-show-all">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($indirect_referral as $k => $val)
                                    <tr>
                                        <td>{{ ++$k }}.</td>
                                        <td>{{ $val->referral->name ?? 'N/A' }}</td>
                                        <td>{{ $val->referral->username ?? 'N/A' }}</td>
                                        <td>{{ date('Y/m/d', strtotime($val->created_at)) }}</td>
                                        <td>{{ date('Y/m/d h:i:A', strtotime($val->updated_at)) }}</td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@stop
