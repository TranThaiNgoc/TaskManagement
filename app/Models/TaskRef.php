<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskRef extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'task_ref';
    protected $fillable = ['project_id', 'task_id'];
}
