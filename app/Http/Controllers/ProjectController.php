<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskRef;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::orderBy('id', 'desc')->get();
        
        return view('projects.index', compact('projects'));
    }

    public function create() {
        $tasks = Task::orderBy('priority', 'asc')->get();
        
        return view('projects.create', compact('tasks'));
    }

    public function store(ProjectRequest $request) {
        $project = Project::create(['name' => $request->name]);

        foreach ($request->tasks as $task) {
            TaskRef::create([
                'project_id' => $project->id,
                'task_id' => $task,
            ]);
        }

        return redirect()->route('projects.index')->with('alert_success', 'Add project successfully.'); 
    }

    public function edit($project_id) {
        $project = Project::findOrFail($project_id);
        $tasks = Task::orderBy('priority', 'asc')->get();
        
        $data = [
            'project' => $project,
            'tasks' => $tasks
        ];

        return view('projects.edit', $data);
    }

    public function update(ProjectRequest $request, $project_id) {
        $project = Project::findOrFail($project_id);
        $project->update(['name' => $request->name]);

        $TaskRef = TaskRef::where('project_id', $project->id)->pluck('task_id')->toArray();
        TaskRef::where('project_id', $project->id)->whereNotIn('task_id', $request->tasks)->delete();
        foreach($request->tasks as $task) {
            if(!in_array($task, $TaskRef)) {
                TaskRef::create([
                    'project_id' => $project->id,
                    'task_id' => $task
                ]);
            }
        }

        return redirect()->route('projects.index')->with('alert_success', 'Updated project successfully.'); 
    }

    public function delete($project_id) {
        $project = Project::findOrFail($project_id);

        TaskRef::where('project_id', $project_id)->delete();
        $project->delete();

        return redirect()->route('projects.index')->with('alert_success', 'Deleted project successfully.'); 
    }
}
