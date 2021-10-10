<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TaskCategory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //find all categories that exist and get their ids
        $categories = TaskCategory::all()->pluck('id');
        //create a fake task
        return [
            'name' => $this->faker->sentence(5),
            'description' => $this->faker->sentence(30),
            'category_id' => $categories->random()//assign random category because category not nullable
        ];
    }
}
