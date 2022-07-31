<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use DB;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::orderBy('priority', 'asc')->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create() {
        return view('tasks.create');
    }

    public function store(TaskRequest $request) {
        $task = Task::create($request->all());

        return redirect()->route('tasks.index')->with('alert_success', 'Add task successfully.'); 
    }

    public function edit($task_id) {
        $task = Task::findOrFail($task_id);

        return view('tasks.edit', compact('task'));
    }

    public function update(TaskRequest $request, $task_id) {
        $task = Task::findOrFail($task_id);

        $task->update($request->all());
        return redirect()->route('tasks.index')->with('alert_success', 'Updated task successfully.'); 
    }

    public function delete($task_id) {
        $task = Task::findOrFail($task_id);

        $task->delete();

        return redirect()->route('tasks.index')->with('alert_success', 'Deleted task successfully.'); 
    }

    public function priority(Request $request) {
        foreach($request->priority as $key => $value) {
            DB::table('tasks')->where('id', $value)->update(['priority' => $key]);
        }

        return response()->json(['success'=>'Updated priority successfully']);
    }
}
