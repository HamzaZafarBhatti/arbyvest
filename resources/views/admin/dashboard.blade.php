@extends('admin.layout.master')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="content">
        <div class="row">
            {{-- <div class="col-md-4">
                <div class="card border-left-3 border-left-violet rounded-left-0">
                    <div class="card-body">
                        <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                            <div>
                                <h6 class="font-weight-semibold">Users</h6>
                                <ul class="list list-unstyled mb-0">
                                    <li>Active users: <span
                                            class="font-weight-semibold text-default">#{{ $activeusers ?? '' }}</span></li>
                                    <li>Blocked users: <span
                                            class="font-weight-semibold text-default">#{{ $blockedusers ?? '' }}</span></li>
                                </ul>
                            </div>

                            <div class="text-sm-right mb-0 mt-3 mt-sm-0 ml-auto">
                                <h3 class="font-weight-semibold">#{{ $totalusers ?? '' }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@stop
