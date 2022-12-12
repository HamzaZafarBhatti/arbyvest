@extends('admin.layout.master')

@section('title', 'Edit Market Price')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Edit Market Price</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-danger"></p>
                        <form action="{{ route('admin.market_prices.update', $marketPrice->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Currency Name:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="currency_name" class="form-control" value="{{ $marketPrice->currency_name }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Currency Symbol:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="symbol" class="form-control" value="{{ $marketPrice->symbol }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Arbyvest rate:</label>
                                <div class="col-lg-10">
                                    <input type="number" step=".01" name="local_rate" value="{{ $marketPrice->local_rate }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Black Market rate:</label>
                                <div class="col-lg-10">
                                    <input type="number" step=".01" name="black_market_rate" value="{{ $marketPrice->black_market_rate }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Status:</label>
                                <div class="col-lg-10">
                                    <select class="form-control select" name="is_active" required>
                                        <option value="1" {{ $marketPrice->is_active ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ !$marketPrice->is_active ? 'selected' : '' }}>Disable
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn bg-dark">Submit<i
                                        class="icon-paperbanke ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
