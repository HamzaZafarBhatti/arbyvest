@extends('admin.layout.master')

@section('title', 'Roles')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-5 col-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Add Role</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.roles.store') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Role Name:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="name" class="form-control" required>
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
                        <h6 class="card-title font-weight-semibold">Roles</h6>
                    </div>
                    <div class="">
                        <table class="table datatable-show-all">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Role Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$records->isEmpty())
                                    @foreach ($records as $k => $val)
                                        <tr>
                                            <td>{{ ++$k }}.</td>
                                            <td>{{ $val->name }}</td>
                                            <td class="text-center">
                                                <div class="list-icons">
                                                    <div class="dropdown">
                                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class='dropdown-item'
                                                                href="{{ route('admin.roles.edit', $val->id) }}"><i
                                                                    class="icon-pencil7 mr-2"></i>Edit</a>
                                                            <a class='dropdown-item' onclick="event.preventDefault(); document.getElementById('form{{$val->id}}').submit();"
                                                                href="{{ route('admin.roles.destroy', $val->id) }}"><i
                                                                    class="icon-trash mr-2"></i>Delete</a>
                                                            <form action="{{ route('admin.roles.destroy', $val->id) }}" method="post" id="form{{$val->id}}">
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
                                        <td colspan="3">No record found!</td>
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
