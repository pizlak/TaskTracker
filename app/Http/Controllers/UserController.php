<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        Cookie::queue('name: ' . $user->name, $user->email, 60 * 24 * 365);
        $tasks = Task::where('user_id', $user->id)->orderByDesc('status')->get();

        return view('profile', compact('user', 'tasks'));
    }

    public function updateUser(Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email')];
        Auth::user()->update($data);

        return redirect(route('profile.setting', Auth::user()->id));
    }

    public function editPassword(Request $request)
    {
        if (!Hash::check($request->input('old_password'), Auth::user()->password)) {
            return 'error 1';
        }
        if ($request->input('new_password') !== $request->input('confirmed_password')) {
            return 'error 2';
        }
        Auth::user()->update(['password' => Hash::make($request->input('new_password'))]);

        return redirect(route('profile.setting', Auth::user()->id));
    }

    public function viewUserSetting()
    {
        $user = Auth::user();

        return view('setting', compact('user'));
    }
}
