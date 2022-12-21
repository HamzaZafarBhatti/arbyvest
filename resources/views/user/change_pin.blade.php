@extends('user.layout.app')

@section('title', 'Change Pin')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="header-title">
                <h3 class="card-title pb-3">Change Pin</h3>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('user.do_change_pin') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="old_pin" class="form-label">Old Pin</label>
                            <input type="text" class="form-control @if ($errors->get('old_pin')) is-invalid @endif"
                                id="old_pin" name="old_pin" required>
                            @if ($errors->get('old_pin'))
                                <div class="invalid-feedback">
                                    @foreach ((array) $errors->get('old_pin')[0] as $message)
                                        {{ $message }}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="new_pin" class="form-label">New Pin</label>
                            <input type="text" class="form-control @if ($errors->get('new_pin')) is-invalid @endif"
                                id="new_pin" name="new_pin" required>
                            @if ($errors->get('new_pin'))
                                <div class="invalid-feedback">
                                    @foreach ((array) $errors->get('new_pin')[0] as $message)
                                        {{ $message }}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="new_pin_confirmation" class="form-label">Confirm New Pin</label>
                            <input type="text" class="form-control" id="new_pin_confirmation" name="new_pin_confirmation"
                                required>
                        </div>
                    </div>
                </div>
                <div class="pt-2 text-center text-md-start">
                    <button class="btn btn-primary" type="submit">
                        Change Pin
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
