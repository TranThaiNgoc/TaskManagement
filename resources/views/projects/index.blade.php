@extends('layouts.app')
@section('content')
@include('boxes.notify')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">List projects</h4>

                <div class="table-responsive" id="tbl">
                    <table class="table mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th class="test_oke">Project name</th>
                                <th>Task name</th>
                                <th>Created at</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $key => $value)
                            <tr id="{{ $value->id }}">
                                <td scope="row">{{ $key }}</td>
                                <td><a href="{{ route('projects.edit', ['project_id' => $value->id]) }}"
                                    class="text-primary">{{$value->name}}</a></td>
                                <td>
                                    @if(count($value->task($value->id)) > 0)
                                    @foreach($value->task($value->id) as $task)
                                        <span class="badge badge-primary">{{ $task->name }}</span>
                                    @endforeach
                                    @endif
                                </td>
                                <td>{{ $value->created_at }}</td>
                                <td style="white-space: nowrap; width: 1%;">
                                    <div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                                        <div class="btn-group btn-group-sm" style="float: none;"><a
                                                href="{{ route('projects.delete', ['project_id' => $value->id]) }}"
                                                onclick="return confirm('Are you sure to delete project ?')"><button
                                                    type="button"
                                                    class="tabledit-edit-button btn btn-danger"
                                                    style="float: none;"><span
                                                    class="mdi mdi-delete"></span></button></a>
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
@endsection