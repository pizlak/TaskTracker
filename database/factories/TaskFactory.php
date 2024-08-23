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
        return [
                'title' => $this->faker->jobTitle(),
                'status' => Task::get()->random()->status,
                'type' => Task::get()->random()->type,
                'description' => $this->faker->text(),
                'user_id' => User::get()->random()->id,
                'parent_id' => $this->faker->randomElement([null, Task::get()->random()->id]),
        ];
    }
}
