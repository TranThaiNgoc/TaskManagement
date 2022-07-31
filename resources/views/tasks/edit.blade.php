@extends('layouts.app')
@section('content')
@include('boxes.notify')
<!-- Form row -->
<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('tasks.update', ['task_id' => $task->id]) }}">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label>Name task</label>
                        <input type="text" class="form-control" id="name" value="{{ $task->name }}"
                            name="name" placeholder="Name Task">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
    <!-- end col -->

</div>
@endsection