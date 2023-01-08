@extends('admin.master')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Pending Withdrawal logs</h6>
                        <div class="header-elements">
                            <button type="button" class="btn btn-primary approve_multi" disabled>Approve Checked</button>
                        </div>
                    </div>
                    <div class="">
                        <table class="table datatable-button-init-basic">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Account Name</th>
                                    <th>Amount</th>
                                    <th>Account Number</th>
                                    <th>Bank name</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($withdraws as $k => $val)
                                    <tr>
                                        <td>{{ ++$k }}. <input type="checkbox" class="withdraw_ids" name="withdraw_ids" value="{{ $val->id }}"></td>
                                        <td>{{ $val->user->name }}</td>
                                        <td>{{ $val->get_amount }}</td>
                                        <td>{{ $val->bank_user->account_number }}</td>
                                        <td>{{ $val->bank_user->bank->bank_name }}</td>
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
                                                                href="{{ route('admin.ref.withdraw_decline', $val->id) }}"><i
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
                                                    <a href="{{ route('admin.ref.withdraw_delete', $val->id) }}"
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
                                                <form action="{{ route('admin.ref.withdraw_approve') }}"
                                                    method="post">
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
            $(document).on('click', '.withdraw_ids', function() {
                console.log($('.withdraw_ids:checked').length);
                if ($('.withdraw_ids:checked').length) {
                    $('.approve_multi').removeAttr('disabled');
                } else {
                    $('.approve_multi').attr('disabled', 'disabled');
                }
            })
            $('.approve_multi').click(function() {
                var approve_ids = []
                $('.withdraw_ids:checked').map(function(index, value) {
                    approve_ids.push(value.value);
                })

                $.ajax({
                    url: '{{ route('admin.ref.withdraw_approve_multi') }}',
                    method: 'POST',
                    data: {
                        ids: approve_ids,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // console.log(response)
                        location.reload(true);
                    }
                })
            })
        })
    </script>
@endsection
