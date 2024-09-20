<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends BaseController
{
    public function create(TaskCreateRequest $request)
    {
        $data = $request->validated();
        $this->taskService->create($data, Auth::user());
        $message = 'Новое напоминае успешно добавлено!';

        return redirect(route('tasks.view'))->with('success', $message);
    }

    public function updateTask(TaskUpdateRequest $request)
    {
        $data = $request->validated();
        $this->taskService->update($request->input('id'), $data);

        return redirect(route('profile.index'));
    }
    public function viewTasks(Request $request)
    {
        $user = Auth::user();
        $taskQuery = Task::query()->where('user_id', $user->id)->where('parent_id', NULL);
        if(isset($request['status'])){
            $tasks = $taskQuery->where('status', $request['status']);
        }
        $tasks = $taskQuery->orderByDesc('status')->paginate(15);

        return view('tasks', compact('tasks', 'user'));
    }
    public function viewTask(Task $task)
    {
        $task = Task::where('id', $task->id)->first();
        $subtasks = $task->subtasks()->orderBy('status', 'desc')->paginate(3);

        return view('task', compact('task', 'subtasks'));
    }

    public function viewSettingTask(Task $task)
    {
        if ($task->user_id !== Auth::user()->id) {
            $message = 'У Вас нет прав доступа к записи c ID ' . $task->id . '!';

            return redirect(route('tasks.view'))->with('danger', $message);
        }

        return view('task_setting', compact('task'));
    }

    public function subtaskCreate(TaskCreateRequest $request)
    {
        $data = $request->validated();
        $this->taskService->createSubtask($data, Auth::user(), $request->input('id'));
        $message = 'Новая подзадача успешно добавлена!';

        return redirect(route('task.view', $request->input('id')))->with('success', $message);
    }

    public function viewSubtaskCreateForm(Task $task)
    {
        return view('subtask_create', compact('task'));
    }

    public function test()
    {
        $tasks = Task::all();
        $users = User::with(['tasks' => function ($q) {
            $q->where('status', 'Выполнено')->where('parent_id', NULL);
        }])->get();

        return view('test', compact('users', 'tasks'));
    }
}
