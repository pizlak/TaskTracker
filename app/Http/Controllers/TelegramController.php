<?php

namespace App\Http\Controllers;

use Facade\FlareClient\Api;
use http\Env;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Telegram;


class TelegramController extends Controller
{
    private const TOKEN = '7054673975:AAGkqzNT36KEPNpQSyqJdB-Vf-Kywu5ajAc';
    private const URL = 'https://api.telegram.org/bot' . self::TOKEN . '/';


  /*  public function setHook()
    {
        $getQuery = [
            'url' => 'https://yourtask.online/set-webhook'
        ];
        $url = self::URL . 'setWebhook?' . http_build_query($getQuery);

        $a = $this->curl($url);
        dd($a);
    }*/

    public function handleWebhook(Request $request)
    {
        $data = json_encode(file_get_contents('php://input'));
        $doc = $_SERVER['DOCUMENT_ROOT'] . '\data.txt';
        $file = fopen($doc, "w");

// Записываем данные в файл
        fwrite($file,  $data);

// Закрываем файл
        fclose($file);

    }

    public function curl($urlQuery)
    {
        $url = curl_init($urlQuery);
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($url, CURLOPT_HEADER, false);

        $response = json_decode(curl_exec($url));
        curl_close($url);

        return $response;
    }

    public function index($message)
    {
        BotController::saveId($this->getUserIdFromMessage());
        $this->deleteMessage();
        $this->sendMessage(BotController::getUserTelegramId(), $message);
    }
    public static function sendMessageKeyboard($userId, $message)
    {
        $getQuery = [
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        [
                            'text' => 'Закрыть задание',
                            'callback_data' => 'ClosedTask',
                        ],
                        [
                            'text' => 'Продлить задание на 7 дней',
                            'callback_data' => 'ExtendTask',
                        ],
                    ]
                ],
                'one_time_keyboard' => true,
                'resize_keyboard' => true,
            ]),
            'parse_mode' => 'html',
        ];
        $urlQuery = self::URL . 'sendMessage?chat_id=' . $userId . '&text=' . $message . '&' . http_build_query($getQuery);

        return self::curl($urlQuery);
    }

    public function sendMessage(Request $request)
    {
        $date = [
            'chat_id' => 893212413,
            'text' => $request->input('tg-message'),
        ];

        $urlQuery =  self::URL . 'sendMessage?'. http_build_query($date);
        file_get_contents($urlQuery);

        return redirect(route('profile.index'));
    }



}


