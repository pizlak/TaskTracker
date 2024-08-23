<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
class BaseController extends Controller
{
    public $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
}
