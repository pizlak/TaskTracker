<?php

namespace App\Http\Controllers;


use App\Models\Image;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
   public function index() {

   }
   public function show(int $id)
   {
       $user = User::find($id);
       $images = $user->images()->latest()->get();

       return view('album', compact('user', 'images'));
   }
   public function showFullImage(Image $image)
   {
       return view('image', compact('image'));
   }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();
        unset($data['_token']);
        $data['photo'] = $request->file('photo')->store('images', 'public');
        Image::firstOrCreate($data);

        return redirect()->route('album.show', Auth::user()->id);
    }
}
