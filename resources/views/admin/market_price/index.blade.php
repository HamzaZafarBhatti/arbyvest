@extends('admin.layout.master')

@section('title', 'Market Prices')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-5 col-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Set Market Price</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.market_prices.store') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Currency Name:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="currency_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Currency Symbol:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="symbol" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Arbyvest rate:</label>
                                <div class="col-lg-10">
                                    <input type="number" step=".01" name="local_rate" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Black Market rate:</label>
                                <div class="col-lg-10">
                                    <input type="number" step=".01" name="black_market_rate" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Status:</label>
                                <div class="col-lg-10">
                                    <select class="form-control select" name="is_active" required>
                                        <option value="1">Active
                                        </option>
                                        <option value="0">Disable
                                        </option>
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
            </div>
            <div class="col-md-7 col-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Market Rates</h6>
                    </div>
                    <div class="">
                        <table class="table datatable-show-all">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Currency Name</th>
                                    <th>Symbol</th>
                                    <th>Arbyvest Rate</th>
                                    <th>Black Market Rate</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$records->isEmpty())
                                    @foreach ($records as $k => $val)
                                        <tr>
                                            <td>{{ ++$k }}.</td>
                                            <td>{{ $val->currency_name }}</td>
                                            <td>{{ $val->symbol }}</td>
                                            <td>{{ $val->get_local_rate }}</td>
                                            <td>{{ $val->get_black_market_rate }}</td>
                                            <td>
                                                @if (!$val->is_active)
                                                    <span class="badge badge-danger">Disabled</span>
                                                @else
                                                    <span class="badge badge-success">Active</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="list-icons">
                                                    <div class="dropdown">
                                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class='dropdown-item'
                                                                href="{{ route('admin.market_prices.edit', $val->id) }}"><i
                                                                    class="icon-pencil7 mr-2"></i>Edit</a>
                                                            <a class='dropdown-item' onclick="event.preventDefault(); document.getElementById('form{{$val->id}}').submit();"
                                                                href="{{ route('admin.market_prices.destroy', $val->id) }}"><i
                                                                    class="icon-trash mr-2"></i>Delete</a>
                                                            <form action="{{ route('admin.market_prices.destroy', $val->id) }}" method="post" id="form{{$val->id}}">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7">No record found!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
