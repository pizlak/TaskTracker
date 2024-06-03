<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TelegramController extends Controller
{
    private const TOKEN = '7054673975:AAGkqzNT36KEPNpQSyqJdB-Vf-Kywu5ajAc';
    private const URL = 'https://api.telegram.org/bot' . self::TOKEN . '/';

    public function sendMessage(Request $request)
    {
        $userId = $this->getUserId();
        $textMessage = urlencode($request->input('tg-message'));
        $urlQuery = self::URL . 'sendMessage?chat_id=' . $userId . '&text=' . $textMessage;

        $url = curl_init($urlQuery);
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($url, CURLOPT_HEADER, false);

        curl_exec($url);
        curl_close($url);

        return redirect(route('profile.index'));
    }

    public function deleteMessage()
    {
        $url = self::URL . 'getUpdates';
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if($data['ok']){
            $lastUpdate = end($data['result']);
            $lastUpdateId = $lastUpdate['update_id'] + 1;

            $url = self::URL . 'getUpdates?offset=' . $lastUpdateId;
            $response = file_get_contents($url);
            $data = json_decode($response, true);
        }
    }
    public function getUserId()
    {
        $url = self::URL . 'getUpdates';
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        if($data['ok']){
            $lastUpdate = end($data['result']);
            return $lastUpdate['message']['from']['id'];
        }
        return 'error';
    }
}
