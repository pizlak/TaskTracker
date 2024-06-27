<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

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

    public function viewSettingTask($id)
    {
        $task = Task::where('id', request()->route('id'))->firstOrFail();

        return view('task', compact('task'));
    }

    public function dateTask()
    {
        $currentDate = date('d.m.Y');
        $incompleteTasks = Task::where('status', '!=', 'Выполнено')->get();

        foreach ($incompleteTasks as $currentTask) {
            $daysDiffs = (strtotime($currentTask->due_date) - strtotime($currentDate)) / (60 * 60 * 24);
            if ($daysDiffs == 7) {
                $message = $this->getMessage($currentTask->title, $currentTask->description, $currentTask->due_date);
             dd(TelegramController::sendMessageKeyboard(BotController::getUserTelegramId($currentTask->user_id), urlencode($message)));

            }
        }
    }
    public function notification()
    {
        $response = file_get_contents(TelegramController::getUpdates());
        $data = json_decode($response, true);

        if($data['ok']){
            $lastUpdates =  $data['result'];
            foreach ($lastUpdates as $lastUpdate){
                if (isset($lastUpdate['callback_query'])) {
                    $callbackQuery = $lastUpdate['callback_query']['data'];
                    $tgId = $lastUpdate['callback_query']['from']['id'];
                //  dd($tgId);
                    if($callbackQuery === 'ExtendTask'){
                       TelegramController::sendMessage($tgId, urlencode('Задание продлено на 7 дней'));
                    } elseif ($callbackQuery === 'ClosedTask'){
                       TelegramController::sendMessage($tgId, urlencode('Задание закрыто'));
                    }
                } else {
                  echo 'net';
                }
            }
        }
    }
    public function getMessage($title, $description, $dueDate): string
    {
        return <<<MESSAGE
\xE2\x9D\x97\xE2\x9D\x97\xE2\x9D\x97 <b>ВНИМАНИЕ! ДО ЗАВЕРШЕНИЯ ЗАДАНИЯ "<u>$title</u>" ОСТАЛАСЬ ВСЕГО ОДНА НЕДЕЛЯ</b>!

<strong>Название:</strong> <i> $title</i>

<strong>Описание:</strong> $description
<strong>Дата выполнения:</strong> $dueDate
MESSAGE;
    }
}
