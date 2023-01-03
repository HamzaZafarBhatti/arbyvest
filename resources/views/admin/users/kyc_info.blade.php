@extends('admin.layout.master')

@section('title', 'User KYC Information')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-4">
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
                                <li>Last Updated: <span
                                        class="font-weight-semibold">{{ date('Y/m/d h:i:A', strtotime($user->updated_at)) }}</span>
                                </li>
                                <li>Document Type: <span
                                        class="font-weight-semibold">{{ $user->document_type ? $user->document_type->name : 'Not Selected' }}</span>
                                </li>
                                <li>Document:
                                    <span>
                                        @if (!$ext)
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
            </div>
        </div>
    </div>
@stop
