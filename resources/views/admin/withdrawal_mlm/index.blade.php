@extends('admin.master')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Withdraw logs</h6>
                    </div>
                    <div class="">
                        <table class="table datatable-button-init-basic">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Account Name</th>
                                    <th>Facebook Profile Link</th>
                                    <th>Amount</th>
                                    <th>Account Number</th>
                                    <th>Bank Name</th>
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
                                        <td>{{-- <a href="{{ url('admin/manage-user') }}/{{ $val->user_id }}"> --}}{{ $val->user->name }}{{-- </a> --}}
                                        </td>
                                        <td>{{ $val->user->fb_url ?? 'N/A' }}</td>
                                        <td>₦{{ substr($val->amount, 0, 9) }}</td>
                                        <td>{{ $val->account_no }}</td>
                                        <td>{{ $val->bank_name }}</td>
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
                                                        @if ($val->status == 0)
                                                            <a class='dropdown-item' data-toggle="modal"
                                                                data-target="#{{ $val->id }}pay"><i
                                                                    class="icon-thumbs-up3 mr-2"></i>Approve request</a>
                                                            <a class='dropdown-item'
                                                                href="{{ route('admin.mlm.withdraw_decline', $val->id) }}"><i
                                                                    class="icon-thumbs-down3 mr-2"></i>Decline request</a>
                                                        @endif
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
                                                    <a href="{{ route('admin.mlm.withdraw_delete', $val->id) }}"
                                                        class="btn bg-danger">Proceed</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="{{ $val->id }}pay" class="modal fade" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <form action="{{ route('admin.mlm.withdraw_approve') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $val->id }}">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="d-block font-weight-semibold">Select
                                                                Payment</label>
                                                            <div class="form-check form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input"
                                                                        name="payment" value="0">
                                                                    Full Payment
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input"
                                                                        name="payment" value="1">
                                                                    Custom Payment
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group payment_value d-none">
                                                            <input type="text" name="payment_value" class="form-control"
                                                                placeholder="₦5000">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-link"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn bg-success">Approve</button>
                                                    </div>
                                                </form>
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
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function() {
            $('.form-check-input').click(function() {
                var _this = $(this)
                var value = _this.val();
                if (value == 1) {
                    _this.parents('.modal').find('.payment_value').removeClass('d-none')
                } else {
                    _this.parents('.modal').find('.payment_value').addClass('d-none')
                }
            })
        })
    </script>
@endsection
