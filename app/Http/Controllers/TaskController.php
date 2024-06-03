<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function create(Request $request)
    {
        $user = Auth::user();
        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'priority' => $request->input('priority'),
            'user_id' => $user->id,
            'due_date' => $request->input('due_date')];
        Task::firstOrCreate($data);

        return redirect(route('profile.index'));
    }

    public function updateTask(Request $request)
    {
        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'type' => $request->input('type'),
            'priority' => $request->input('priority'),
            'due_date' => $request->input('due_date')];
        Task::find($request->input('id'))->update($data);

        return redirect(route('profile.index'));
    }

    public function viewSettingTask($id){
        $task = Task::where('id', request()->route('id'))->firstOrFail();

        return view('task', compact('task'));
    }
}
