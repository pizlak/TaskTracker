<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use App\Services\UserService;

class BaseController extends Controller
{
    public $taskService;
    public $userService;

    public function __construct(TaskService $taskService, UserService $userService)
    {
        $this->taskService = $taskService;
        $this->userService = $userService;
    }
}
