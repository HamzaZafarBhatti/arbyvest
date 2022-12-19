@extends('admin.layout.master')

@section('title', 'Document Types')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Add Document Type</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-danger"></p>
                        <form action="{{ route('admin.document_types.store') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Name:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                        required>
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
                                    <select class="form-control select" name="is_active" value="{{ old('is_active') }}"
                                        required>
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Deactived</option>
                                    </select>
                                    @if ($errors->get('is_active'))
                                        <div class="text-danger">
                                            <p>{{ $errors->get('is_active')[0] }}</p>
                                        </div>
                                    @endif
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
                        <h6 class="card-title font-weight-semibold">Document Types</h6>
                    </div>
                    <div class="">
                        <table class="table datatable-show-all">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($document_types as $k => $val)
                                    <tr>
                                        <td>{{ ++$k }}.</td>
                                        <td>{{ $val->name }}</td>
                                        <td>
                                            @if ($val->is_active == 0)
                                                <span class="badge badge-danger">Disabled</span>
                                            @elseif($val->is_active == 1)
                                                <span class="badge badge-success">Active</span>
                                            @endif
                                        </td>
                                        <td>{{ date('Y/m/d h:i:A', strtotime($val->created_at)) }}</td>
                                        <td>{{ date('Y/m/d h:i:A', strtotime($val->updated_at)) }}</td>
                                        <td class="text-center">
                                            <div class="list-icons">
                                                <div class="dropdown">
                                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                        <i class="icon-menu9"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class='dropdown-item' href="{{ route('admin.document_types.edit', $val->id) }}">
                                                            <i class="icon-pencil7 mr-2"></i>Edit
                                                        </a>
                                                        <a class='dropdown-item' href="{{ route('admin.document_types.destroy', $val->id) }}" onclick='event.preventDefault(); document.getElementById("form{{$val->id}}").submit()'>
                                                            <i class="icon-trash mr-2"></i>Delete
                                                        </a>
                                                        <form action="{{ route('admin.document_types.destroy', $val->id) }}" method="post" id="form{{ $val->id }}" style="display: none">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
