@extends('admin.master')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title font-weight-semibold">Posts</h6>
                    </div>
                    <table class="table datatable-show-all">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Views</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blog as $k => $val)
                                <tr>
                                    <td>{{ ++$k }}.</td>
                                    <td><img src="{{ url('/') }}/asset/thumbnails/{{ $val->image }}"
                                            style="height: auto; max-width: 30%;"></td>
                                    <td>{{ $val->title }}</td>
                                    <td>{{ $val->views }}</td>
                                    <td>
                                        @if ($val->status == 1)
                                            <span class="badge badge-success">Published</span>
                                        @else
                                            <span class="badge badge-danger">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ date('Y/m/d', strtotime($val->post_date)) }}</td>
                                    <td>{{ date('Y/m/d', strtotime($val->updated_at)) }}</td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @if ($val->status == 1)
                                                        <a class='dropdown-item'
                                                            href="{{ route('admin.blog.unpublish', $val->id) }}"><i
                                                                class="icon-eye-blocked2 mr-2"></i>Unpublish</a>
                                                    @else
                                                        <a class='dropdown-item'
                                                            href="{{ route('admin.blog.publish', $val->id) }}"><i
                                                                class="icon-eye mr-2"></i>Publish</a>
                                                    @endif
                                                    <a class='dropdown-item'
                                                        href="{{ route('admin.blog.edit', $val->id) }}"><i
                                                            class='icon-pencil7 mr-2'></i>Edit</a>
                                                    <a data-toggle="modal" data-target="#{{ $val->id }}delete"
                                                        class="dropdown-item"><i class="icon-bin2 mr-2"></i>Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div id="{{ $val->id }}delete" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <h6 class="font-weight-semibold">Are you sure you want to delete this?</h6>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-link"
                                                    data-dismiss="modal">Close</button>
                                                    
                                                    <form action="{{ route('admin.blog.destroy', $val->id) }}" id="{{ $val->id }}delete-form" method="post">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                <a href="javascript:void(0)" class="btn bg-danger" onclick="event.preventDefault(); document.getElementById('{{ $val->id }}delete-form').submit();">Proceed</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
