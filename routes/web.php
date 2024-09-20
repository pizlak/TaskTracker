<?php

use App\Http\Controllers\CommentaryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TelegramController;
use Illuminate\Support\Facades\Auth;
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


Route::get('/test', [TaskController::class, 'test'])->name('test');

Route::post('/send-message', [TelegramController::class, 'sendMessage'])->name('telegram.sendMessage');

Route::get('/hook', [TelegramController::class, 'setHook']);

Route::get('/', [UserController::class, 'homePage'])->name('home');

Route::get('/id{user}', [UserController::class, 'index'])->name('profile.index');
Route::post('/profile/update', [UserController::class, 'updateUser'])->name('profile.update');
Route::post('/profile/edit_password', [UserController::class, 'editPassword'])->name('profile.edit.password');
Route::get('/id{id}/profile/setting', [UserController::class, 'viewUserSetting'])->name('profile.setting');

Route::get('/tasks/', [TaskController::class, 'viewTasks'])->name('tasks.view');
Route::get('/setting/task/id{task}', [TaskController::class, 'viewSettingTask'])->name('task.setting');
Route::get('/task/id{task}', [TaskController::class, 'viewTask'])->name('task.view');
Route::get('/task/id{task}/subtask', [TaskController::class, 'viewSubtaskCreateForm'])->name('subtask.view');
Route::post('/task/update', [TaskController::class, 'updateTask'])->name('task.update');
Route::post('/profile/task', [TaskController::class, 'create'])->name('task.create');
Route::post('/profile/subtask', [TaskController::class, 'subtaskCreate'])->name('subtask.create');

Route::group(['prefix' => 'album'], function (){
    Route::get('/id{id}', [ImageController::class, 'show'])->name('album.show');
    Route::get('/image-{image}', [ImageController::class, 'showFullImage'])->name('image.show');
    Route::post('/', [ImageController::class, 'store'])->name('album.store');
    Route::group(['prefix' => 'commentary'], function () {
        Route::post('/{image}', [CommentaryController::class, 'store'])->name('commentary.store');
        Route::delete('/{commentary}/delete', [CommentaryController::class, 'delete'])->name('commentary.delete');
    });
});
