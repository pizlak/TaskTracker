<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Task;
use App\Models\User;

class UserService
{
    public function profileImage(User $user): Image
    {
       return Image::where('user_id', $user->id)->orderByDesc('id')->first();
    }
    public function createSubtask (array $data, User $user, int $taskId) : void
    {

    }
    public  function update(int $id, array $data) : void
    {

    }
    public function getTask(int $id) : Task
    {

    }

}
