@extends('admin.master')

@section('content')
    <div class="content">
        @include('admin.alert')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Generate Coupon</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-danger"></p>
                        <form action="{{ route('admin.coupons.store') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Codes Quantity:</label>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <input type="number" step="1" name="quantity" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Plan:</label>
                                <div class="col-lg-10">
                                    <select class="form-control select" name="plan_id" data-fouc required>
                                        <option value="">Select Plan</option>
                                        @if ($plans)
                                            @foreach ($plans as $plan)
                                                <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn bg-dark">Submit<i
                                        class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Coupon Codes</h6>
                        <div class="header-elements">
                            <a type="button" id="download_link" class="btn btn-primary" disabled>Download</a>
                        </div>
                    </div>
                    <div class="">
                        <table class="table datatable-show-all">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Coupon Code</th>
                                    <th>Plan Name</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $k => $val)
                                    <tr>
                                        <td>{{ ++$k }}.</td>
                                        <td>{{ $val->serial }}</td>
                                        <td>{{ $val->plan ? $val->plan->name : 'N/A' }}</td>
                                        <td>
                                            @if ($val->status)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-dFanger">Disabled</span>
                                            @endif
                                        </td>
                                        <td>{{ date('Y/m/d h:i:A', strtotime($val->created_at)) }}</td>
                                        <td>{{ date('Y/m/d h:i:A', strtotime($val->updated_at)) }}</td>
                                        <td class="text-center">
                                            @if ($val->status == 1)
                                                <div class="list-icons">
                                                    <div class="dropdown">
                                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a data-toggle="modal" data-target="#{{ $val->id }}delete"
                                                                class="dropdown-item"><i
                                                                    class="icon-bin2 mr-2"></i>Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($val->status == 1)
                                        <div id="{{ $val->id }}delete" class="modal fade" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6 class="font-weight-semibold">Are you sure you want to delete
                                                            this?
                                                        </h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-link"
                                                            data-dismiss="modal">Close</button>
                                                        <a href="{{ route('admin.coupons.destroy', $val->id) }}"
                                                            onclick="event.preventDefault(); document.getElementById('logout-form{{ $val->id }}').submit();"
                                                            class="btn bg-danger">Proceed</a>
                                                        <form id="logout-form{{ $val->id }}"
                                                            action="{{ route('admin.coupons.destroy', $val->id) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
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
        console.log('{{ Session::get('download_link') }}')
        if ('{{ Session::get('download_link') }}') {
            // location.reload(true);
            $('#download_link').removeClass('disabled').attr('href',
                    '{{ url(Session::get('download_link') ?? 'https://rubicnetwork.com/rubicnetworkadministration') }}')
                .trigger('click');
        } else {
            $('#download_link').addClass('disabled')
        }
    </script>
@endsection
