<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends BaseController
{
    public function create(TaskCreateRequest $request)
    {
        $data = $request->validated();
        $this->taskService->create($data, Auth::user());
        $message = 'Новое напоминае успешно добавлено!';

        return redirect(route('profile.index'))->with('success', $message);
    }

    public function updateTask(TaskUpdateRequest $request)
    {
        $data = $request->validated();
        $this->taskService->update($request->input('id'), $data);

        return redirect(route('profile.index'));
    }

    public function viewTask(Task $task)
    {
        $task = Task::where('id', $task->id)->with('subtasks')->first();

        return view('task', compact('task'));
    }

    public function viewSettingTask(Task $task)
    {
        if($task->user_id !== Auth::user()->id){
            $message = 'У Вас нет прав доступа к записи c ID ' . $task->id . '!';

            return redirect(route('profile.index'))->with('danger', $message);
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
}
