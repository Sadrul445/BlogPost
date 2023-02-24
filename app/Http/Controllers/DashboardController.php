<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show_post(Request $request){
        $posts = Post::all();
        return view('dashboard',['posts'=>$posts]);
    }
}
