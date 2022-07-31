@extends('layouts.app')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
<link href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

@include('boxes.notify')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">List tasks</h4>

                <div class="table-responsive" id="tbl">
                    <table class="table mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th class="test_oke">Task name</th>
                                <th>Created at</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $key => $value)
                            <tr id="{{ $value->id }}">
                                <td scope="row">{{ $key }}</td>
                                <td><a href="{{ route('tasks.edit', ['task_id' => $value->id]) }}"
                                    class="text-primary">{{$value->name}}</a></td>
                                <td>{{ $value->created_at }}</td>
                                <td style="white-space: nowrap; width: 1%;">
                                    <div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                                        <div class="btn-group btn-group-sm" style="float: none;"><a
                                                href="{{ route('tasks.delete', ['task_id' => $value->id]) }}"
                                                onclick="return confirm('Are you sure to delete task ?')"><button
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

<script>
    $("#tbl tbody").sortable({
    items: 'tr',
    cursor: 'pointer',
    axis: 'y',
    dropOnEmpty: false,
    start: function(e, ui) {
        ui.item.addClass("selected");
    },
    
    stop: function(e, ui) {
        $("#tbl tbody tr").each((idx, tr) => {
            $("td:nth-child(1)", tr).text(idx);
        });
        var data = $.makeArray($('tbody tr[id]').map(function() {
            return this.id;
        }));

        let _token   = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: '{{ route('tasks.priority') }}',
            data: {
                priority:data,
                _token: _token
            },
            success:function(response){
                if(response) {
                        toastr.success(response.success);
                }
            },
            error: function(error) {
                // console.log(error);
                // $('#nameError').text(response.responseJSON.errors.name);
            }
        });
    }

});
</script>
@endsection