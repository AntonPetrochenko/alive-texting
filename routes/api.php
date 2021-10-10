<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
use App\Models\User;

//i sure hope all this is psr

//this is all kinds of wrong, but mostly for demo purposes
//user route contains shorthands for actions a user would perform
Route::prefix('/user')->middleware(['web','auth:sanctum'])->group( function () {
    Route::get('/', function (Request $request) { //get info about self
        return $request->user();
    });
    Route::prefix('/tasks')->group(function () {
        Route::get('/', function (Request $request) { //get own tasks
            return $request->user()->tasks;
        });  
        Route::post('/trade', [TaskController::class, 'trade']); //trade tasks

        Route::post('/resolve', [TaskController::class, 'done']); //resolve tasks
    });
});

Route::prefix('/account')->middleware('web')->group(function () {
    Route::post('/register',[UserController::class, 'register']);
    Route::post('/login',[UserController::class, 'authenticate']);
});

//for demonstration purposes, the rest are not protected. go ahead, do your worst
Route::prefix('/developers')->group(function () {
    Route::get('/',function () {
        return User::all(); //get all the everything
    });
    Route::prefix('{user}')->group(function () {
        Route::get('/',function (User $user) { //implicit binding
            return $user;
        });
        Route::get('/tasks', function(User $user) {
            return $user->tasks; //returns loaded relation, not id
        });
    });
});

Route::prefix('tasks')->group(function () {
    Route::get('/',function () {
        return Task::all(); //get every task that 
    });
    Route::prefix('{task}')->group(function () {
        
        Route::get('/', function(Task $task) { //implicit binding
            return $task;
        });

        //classic non-mvc routes as a cherry on top
        Route::get('/assignee',function (Task $task) { // GET /tasks/{task_id}/assignee
            return $task->assignee; //returns loaded relation
        });

        Route::post('/assignee',function (Request $request,Task $task) { // POST tasks/{task_id}/assignee
            $request->validate([
                'user_id' => 'required|exists:users,id'
            ]);
            $user_id = $request->input('user_id');
            return [ "success" => $task->assign($user_id) ];
        });

    });
});