<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show_post(Request $request){
        $posts = Post::paginate(3);
        return view('home',['posts'=>$posts]);
    }
}
