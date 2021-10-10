<?php

namespace Database\Seeders;

use Database\Factories\TaskFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(30)->create();
        $defaultTaskCategories =   
        [
            ["name" => "Fundamentals"],
            ["name" => "String"],
            ["name" => "Algorithms"],
            ["name" => "Mathematic"],
            ["name" => "Performance"],
            ["name" => "Booleans"],
            ["name" => "Functions"]
        ];
        DB::table('task_categories')->insert($defaultTaskCategories);

        \App\Models\Task::factory(20)->create();
    }
}
