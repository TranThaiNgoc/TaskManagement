<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Project extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'projects';
    protected $fillable = ['id', 'name'];

    public function Task($project_id) {
        return DB::table('task_ref')
                ->join('tasks', 'task_ref.task_id', '=', 'tasks.id')
                ->join('projects', 'task_ref.project_id', '=', 'projects.id')
                ->where('task_ref.project_id', $project_id)
                ->whereNull('task_ref.deleted_at')
                ->orderBy('tasks.priority', 'asc')
                ->select('tasks.*')->get();
    }
}
