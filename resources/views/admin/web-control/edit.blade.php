@extends('admin.layout.master')

@section('title', $title)

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title font-weight-semibold">Update About us</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.content_pages.update', ['page' => $page]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Details:</label>
                        <textarea type="text" name="value" class="tinymce form-control">{{ $content_page ? $content_page->value : '' }}</textarea>
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
