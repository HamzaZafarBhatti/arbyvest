@extends('admin.master')

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title font-weight-semibold">Update Notice Board</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.web.update_notice') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Details:</label>
                        <div class="col-lg-10">
                            <textarea type="text" name="details" class="tinymce form-control">{{ $value->notice }}</textarea>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn bg-dark">Submit<i class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@stop
