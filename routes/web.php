<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'projects'], function() {
    Route::get('', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/create', [ProjectController::class, 'store']);
    Route::get('/{project_id}', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::patch('/{project_id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::get('/delete/{project_id}', [ProjectController::class, 'delete'])->name('projects.delete');
});

Route::group(['prefix' => 'tasks'], function() {
    Route::get('', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/create', [TaskController::class, 'store']);
    Route::get('/{task_id}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::patch('/{task_id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::get('/delete/{task_id}', [TaskController::class, 'delete'])->name('tasks.delete');
    Route::post('/priority', [TaskController::class, 'priority'])->name('tasks.priority');
});