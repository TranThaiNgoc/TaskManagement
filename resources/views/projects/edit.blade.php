@extends('layouts.app')
@section('content')
@include('boxes.notify')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">Project</h4>

                <form method="POST" action="{{ route('projects.update', ['project_id' => $project->id]) }}">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label>Name project</label>
                        <input type="text" class="form-control" id="name" value="{{ $project->name }}"
                            name="name" placeholder="Name project">
                    </div>

                    <h5 class="font-14 mt-4">List tasks</h5>

                    <select class="form-control select2-multiple mt-2" name="tasks[]" data-toggle="select2" multiple="multiple" data-placeholder="Tasks ...">
                        <optgroup label="Mountain Time Zone">
                            @foreach($tasks as $task)
                            <option value="{{ $task->id }}" {{ in_array($task->id, $project->task($project->id)->pluck('id')->toArray()) == true ? ' selected="selected"' : '' }}>{{ $task->name }}</option>
                            @endforeach
                        </optgroup>
                    </select>
                    
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end col -->

</div>

@endsection