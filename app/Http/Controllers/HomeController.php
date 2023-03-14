<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show_post(Request $request)
    {
        $posts = Post::paginate(3);
        return view('home', ['posts' => $posts]);
    }

    public function sendnotification()
    {
        $user = User::all();

        $details = [
            'greeting' => 'Hi Laravel Developer',
            'body' => 'this is the Email Body',
            'actiontext' => 'this is the actiontext',
            'actionurl' => '/',
            'lastline' => 'this is the LASTLINE',

        ];
        Notification::send($user, new SendEmailNotification($details));
        dd('done');
    }
}
