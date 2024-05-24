<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function homePage()
    {
        return view('welcome');
    }
    public function index()
    {
        $user = User::find(1);
        $tasks =  Task::all()->where('user_id', $user->id)->sortByDesc('status');
        return view('tasks', compact('user', 'tasks'));
    }
}
