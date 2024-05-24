<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {

    }

    public function create(Request $request)
    {
        $user = User::find(2);
        $taskData = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'priority' => $request->input('priority'),
            'user_id' => $user->id,
            'due_date' => $request->input('due_date'),

        ];
        Task::firstOrCreate($taskData);
        return redirect('/profile');
    }
}
