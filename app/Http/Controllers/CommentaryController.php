<?php

namespace App\Http\Controllers;

use App\Models\Commentary;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentaryController extends Controller
{
    public function store(Image $image, Request $request){
        $data = $request->all();
        $data['image_id'] = $image->id;
        $data['user_id'] = Auth::id();
        unset($data['_token']);
        Commentary::create($data);

        return redirect()->back();
    }

    public function delete(Commentary $commentary)
    {
        $commentary->delete();

        return redirect()->back();
    }
}
