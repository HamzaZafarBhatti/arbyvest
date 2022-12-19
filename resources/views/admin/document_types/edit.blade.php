@extends('admin.layout.master')

@section('title', 'Edit Document Type')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Edit</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-danger"></p>
                        <form action="{{ route('admin.document_types.update', $documentType->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Name:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="name" class="form-control" value="{{ $documentType->name }}" required>
                                    @if ($errors->get('name'))
                                        <div class="text-danger">
                                            <p>{{ $errors->get('name')[0] }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Status:</label>
                                <div class="col-lg-10">
                                    <select class="form-control select" name="is_active" required>
                                        <option value="">Select Status</option>
                                        <option value="1" @if ($documentType->is_active == 1) selected @endif>Active</option>
                                        <option value="0" @if ($documentType->is_active == 0) selected @endif>Deactived</option>
                                    </select>
                                    @if ($errors->get('is_active'))
                                        <div class="text-danger">
                                            <p>{{ $errors->get('is_active')[0] }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn bg-dark">Update<i
                                        class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
