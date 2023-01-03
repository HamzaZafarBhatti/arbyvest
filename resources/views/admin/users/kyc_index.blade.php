@extends('admin.layout.master')

@section('title', 'Users')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Users</h6>
                    </div>
                    <div class="">
                        <table class="table datatable-show-all">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Created</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $k => $val)
                                    <tr>
                                        <td>{{ ++$k }}.</td>
                                        <td>{{ $val->name }}</td>
                                        <td>{{ $val->username }}</td>
                                        <td>{{ $val->email }}</td>
                                        <td>{{ date('Y/m/d', strtotime($val->created_at)) }}</td>
                                        <td class="text-center">
                                            @if ($val->birthdate != null && $val->document_type_id != null && $val->document_pic != null && $val->selfie != null)
                                                <div class="list-icons">
                                                    <div class="dropdown">
                                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class='dropdown-item' href="{{ route('admin.users.kyc_info', $val->id) }}"><i
                                                                    class="icon-cogs spinner mr-2"></i>Check KYC Information</a>
                                                            <a class='dropdown-item' href="{{ route('admin.users.verify_account', $val->id) }}" onclick="event.preventDefault(); document.getElementById('form{{$val->id}}').submit()"><i
                                                                    class="icon-cogs spinner mr-2"></i>Verify User</a>
                                                            <form action="{{ route('admin.users.verify_account') }}" method="post" id="form{{$val->id}}">
                                                                @csrf
                                                                <input type="hidden" value="{{ $val->id }}" name="user_id">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                User has not submitted KYC yet!
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
