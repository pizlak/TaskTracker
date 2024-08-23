<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;

class TaskService
{
    public function create(array $data, User $user) : void
    {
        Task::firstOrCreate($data, ['user_id' => $user->id]);
    }
    public function createSubtask (array $data, User $user, int $taskId) : void
    {
        Task::firstOrCreate($data, ['user_id' => $user->id, 'parent_id' => $taskId]);
    }
    public  function update(int $id, array $data) : void
    {
        Task::find($id)->update($data);
    }
    public function getTask(int $id) : Task
    {
        return Task::findOrFail($id);
    }

}
