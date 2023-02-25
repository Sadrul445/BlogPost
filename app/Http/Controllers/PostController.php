<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class PostController extends Controller
{

    public function index()
    {
        return view('post');
    }
    public function index_post_api()
    {
        return response()->json(Post::all(), 200);
    }

    public function create(Request $request)
    {
        $user = $request->user();

        $post = new Post;
        $post->author = $request->author;
        $post->title = $request->title;
        $post->description = $request->description;
        $user->post()->save($post);
        return redirect(route('post_index'))->with('status', 'Post Added Successfully');
    }

    public function store(Request $request)
    {
        //validation
        $post = $request->validate(
            [
                'author' => 'required',
                'title'  => 'required',
                'description' => 'required',
            ]
        );
        return Post::create($request->all());
    }

    //show single products 
    public function show_post_api(Request $request, $id)
    {
        return Post::find($id);
    }

    public function edit(Request $request, $id)
    {
        $post = Post::find($id);
        return view('/editpost', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->author = $request->author;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        return redirect(route('dashboard'))->with('status', 'Post Updated Successfully !!');
    }
    public function update_post_api(Request $request, $id)
    {
        $post = Post::find($id);
        $post->update($request->all());
        $post->save();
        return $post;
    }

    public function destroy(Request $request, $id)
    {
        Post::destroy($id);
        return redirect(route('dashboard'))->with('status', 'Post Deleted Successfully !!');
    }
    public function destroy_post_api(Request $request, $id)
    {
        return post::destroy($id);
    }
}
