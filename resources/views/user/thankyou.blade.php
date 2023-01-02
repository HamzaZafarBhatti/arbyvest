@extends('user.layout.app')
@section('title', 'Thank you')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center mb-5 pt-5">
                                <h3 class="error-title mt-5"><span>Well Done!</span></h3>
                                <h4 class="text-uppercase mt-5">Black Market Sale is Completed
                                </h4>
                                <div class="mt-5 text-center">
                                    <a class="btn btn-primary waves-effect waves-light"
                                        href="{{ route('user.sell_to_blackmarket') }}">Back to
                                        Black Market Sale</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
