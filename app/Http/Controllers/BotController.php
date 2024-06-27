<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class BotController extends Controller
{
    public static function saveId($telegramId)
    {
        $data = [
            'tg_id' => $telegramId,
            'user_id' => Auth::user()->id
        ];

        if (self::getUserId() != Auth::user()->id) {
            Bot::firstOrCreate($data);
        }
    }

     public static function getUserTelegramId($user_id)
     {
         return Bot::where('user_id', $user_id)->pluck('tg_id')->first();
     }

    public static function getUserId()
    {
        return Bot::where('user_id', Auth::user()->id)->pluck('user_id')->first();
    }
}
