@extends('admin.master')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Pending Payment Proof logs</h6>
                        <div class="header-elements">
                            <button type="button" class="btn btn-primary approve_multi" disabled>Approve Checked</button>
                        </div>
                    </div>
                    <div class="">
                        <table class="table datatable-basic">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>Phone</th>
                                    <th>Caption</th>
                                    <th>Image</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paymentproof as $k => $val)
                                    <tr>
                                        <td>{{ ++$k }}. <input type="checkbox" class="proof_ids" name="proof_ids"
                                                value="{{ $val->id }}"></td>
                                        <td><a
                                                href="{{ url('admin/manage-user') }}/{{ $val->user->id }}">{{ $val->user->name }}</a>
                                        </td>
                                        <td>{{ $val->user->email }}</td>
                                        <td>{{ $val->user->phone }}</td>
                                        <td>{{ $val->caption }}</td>
                                        <td><img src="{{ url('/') }}/asset/payment_proofs/{{ $val->image }}"
                                                style="height: auto; max-width: 40%;"></td>
                                        <td>{{ date('Y/m/d h:i:A', strtotime($val->created_at)) }}</td>
                                        <td>{{ date('Y/m/d h:i:A', strtotime($val->updated_at)) }}</td>
                                        <td class="text-center">
                                            <div class="list-icons">
                                                <div class="dropdown">
                                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                        <i class="icon-menu9"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class='dropdown-item'
                                                            href="{{ route('admin.paymentproof.approve', $val->id) }}"><i
                                                                class="icon-thumbs-up3 mr-2"></i>Approve request</a>
                                                        <a class='dropdown-item'
                                                            href="{{ route('admin.paymentproof.decline', $val->id) }}"><i
                                                                class="icon-thumbs-down3 mr-2"></i>Decline request</a>
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
                                                    <a href="{{ route('admin.paymentproof.delete', $val->id) }}"
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
    </div>
@stop
@section('script')
    <script>
        $(document).ready(function() {
            $('.proof_ids').click(function() {
                console.log($('.proof_ids:checked').length);
                if ($('.proof_ids:checked').length) {
                    $('.approve_multi').removeAttr('disabled');
                } else {
                    $('.approve_multi').attr('disabled', 'disabled');
                }
            })
            $('.approve_multi').click(function() {
                var approve_ids = []
                $('.proof_ids:checked').map(function(index, value) {
                    approve_ids.push(value.value);
                })
                // console.log(approve_ids);
                $.ajax({
                    url: '{{ route('admin.paymentproof.approve_multi') }}',
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
