<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\Image;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;


class UserController extends BaseController
{
    public function homePage()
    {
        if (Auth::user()) {
            return redirect(route('profile.index', Auth::user()->id));
        } else {
            return redirect(route('login'));
        }
    }
    public function index(User $user)
    {
        Cookie::queue('name: ' . $user->name, $user->email, 60 * 24 * 365);
        $profileImage = $this->userService->profileImage($user);
        $previewAlbumImages = Image::where('user_id', $user->id)->latest()->limit(5)->get();

        return view('profile', compact('user', 'profileImage', 'previewAlbumImages'));
    }

    public function updateUser(/*UserUpdateRequest*/ Request $request)
    {
        $data = $request->all();

        User::find(Auth::user()->id)->update($data);

        return redirect(route('profile.setting', Auth::user()->id));
    }

    public function editPassword(Request $request)
    {
        if (!Hash::check($request->input('old_password'), Auth::user()->password)) {

            return 'не верный пароль';
        }
        if ($request->input('new_password') !== $request->input('confirmed_password')) {
            return 'новые пароли не совпадают';

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
