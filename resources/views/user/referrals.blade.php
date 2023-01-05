@extends('user.layout.app')

@section('title', 'My Referrals')

@section('css')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <div class="header-title">
                        <h3 class="card-title pb-3">My Referrals</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">S/N</th>
                                    <th scope="col">Downline Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($downlines) > 0)
                                    @foreach ($downlines as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->downline_referral_log->get_amount ?? 'No Transfer has been done!' }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3">No Data Found!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <div class="header-title">
                        <h3 class="card-title pb-3">My Referral Link</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="form-group">
                            <input type="text" value="{{ route('user.register').'?referral='.auth()->user()->username }}" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
