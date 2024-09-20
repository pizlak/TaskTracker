<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userId = User::inRandomOrder()->first()->id;
        $task = Task::where('user_id', $userId)->where('parent_id', NULL)->inRandomOrder()->first();
        $data = [
            'title' => $this->faker->jobTitle(),
            'status' => Task::get()->random()->status,
            'type' => Task::get()->random()->type,
            'description' => $this->faker->text(),
            'user_id' => $userId,
            'parent_id' => NULL,
        ];
        if(isset($task->id)){
            $data['parent_id'] = $this->faker->randomElement([NULL, $task->id]);
        }
        return $data;
    }
}
