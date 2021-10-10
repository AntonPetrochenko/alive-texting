<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function trade(Request $request) {
        $trade = $request->validate([
            'my_task_id' => ['required','exists:tasks,id'],
            'new_task_id' => ['required','exists:tasks,id']
        ]);

        //Now let's do some manual validation, just cuz we can
        $my_task = Task::find($trade["my_task_id"]);
        $new_task = Task::find($trade["new_task_id"]);

        //return [$my_task, $new_task];

        $is_my_task = $request->user()->can('manage-task',$my_task);
        $target_is_not_owned = !$new_task->is_assigned();

        
        if ($is_my_task && $target_is_not_owned) {
            $my_task->decline();
            return [ "success" => $new_task->assign($request->user()->id) ];
        }

        //if we reached here, the input is invalid. _but why?_

        $messages = [];
        $is_my_task ?: array_push($messages,"Not your task");
        !$target_is_not_owned ?: array_push($messages,"Target already assigned");

        return ["messages" => $messages];
    }

    public function done(Request $request) {
        $resolution = $request->validate([
            'task_id' => ['required','exists:tasks,id']
        ]);
        $task_to_resolve = Task::find($resolution["task_id"]);
        if ($request->user()->can("manage-task",$task_to_resolve)) {
            return [ "success" => $task_to_resolve->resolve() ];
        } else {
            return [ "message" => "Not your task" ];
        }
    }
}
