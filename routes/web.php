<?php

use App\Http\Controllers\BotController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TelegramController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::post('/send-message', [TelegramController::class, 'sendMessage'])->name('telegram.sendMessage');


Route::get('/hook', [TelegramController::class, 'setHook']);

Route::get('/', [UserController::class, 'homePage'])->name('home');

Route::get('/profile', [UserController::class, 'index'])->name('profile.index');
Route::post('/profile/update', [UserController::class, 'updateUser'])->name('profile.update');
Route::post('/profile/edit_password', [UserController::class, 'editPassword'])->name('profile.edit.password');
Route::get('/id{id}/profile/setting', [UserController::class, 'viewUserSetting'])->name('profile.setting');

Route::get('/task/{id}', [TaskController::class, 'viewSettingTask'])->name('task.setting');
Route::post('/task/update', [TaskController::class, 'updateTask'])->name('task.update');
Route::post('/profile/task', [TaskController::class, 'create'])->name('task.create');
