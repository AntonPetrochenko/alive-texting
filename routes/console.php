<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use App\Models\Task;
/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('fun:manage', function () {
    //AI-assisted management
            //Make up some tasks
            Task::factory(30)->create();

            //Line up your devs
            $dev_ids = User::all()->pluck("id");

            foreach ($dev_ids as $dev_id) {
                //Throw some random tasks at the poor lads
                Task::where('assignee_id',null)->inRandomOrder()->take(3)->update(["assignee_id" => $dev_id]);
            }
            
            //Because that's how the management song and dance goes, right?
})->purpose('Syngergize rapid developed software solutions by vertically integrating your developers');

