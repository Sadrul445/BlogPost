<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

// use Illuminate\Support\Facades\File;

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
        $post->pimage = $request->p_image;
        $post->author = $request->author;
        $post->title = $request->title;
        $post->description = $request->description;
        $user->post()->save($post);
        return redirect(route('post_index'))->with('status', 'Post Added Successfully');
    }

    public function store(Request $request)
    {
        //validation
        $request->validate(
            [
                'p_image' => 'required',
                'title'  => 'required|string',
                'author_name' => 'required|string',
                'publication_date' => 'required',
                'description' => 'required',
                'user_id' => 'required|integer|exists:users,id',
            ]
        );
        $p_image = $request->file('p_image')->store('p_images','public');

        $post = Post::create(
            [
                'p_image'=>$p_image,
                'title'=>$request->title,
                'author_name'=>$request->author_name,
                'publication_date'=>$request->publication_date,
                'description'=>$request->description,
                'user_id'=>$request->user_id
            ]
        );
        return response()->json([
            'message' => 'Image Uploaded',
            'status' => 'success',
            'post' => $post
        ],200);
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
        $post->title = $request->title;
        $post->author_name = $request->author_name;
        $post->image = $request->image;
        $post->description = $request->description;
        $post->save();

        return redirect(route('dashboard'))->with('status', 'Post Updated Successfully !!');
    }


    public function update_post_api(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $post->title = $request->title;
        $post->author_name = $request->author_name;
        $post->publication_date = $request->publication_date;

        $destination= public_path("storage\\".$post->p_image); //Store_image_file
        if($request->hasFile('new_image')){
            if(File::exists($destination)){
                File::delete($destination);
            }
            $p_image = $request->file('new_image')->store('updated_posts','public');
        }else{
            $p_image= $request->p_image;
            }
       
        $post->description = $request->description;
        $post->user_id = $request->user_id;

        $result= $post->save();
        return $post;
    }

    public function destroy(Request $request, $id)
    {
        Post::destroy($id);
        return redirect(route('dashboard'))->with('status', 'Post Deleted Successfully !!');
    }
    public function destroy_post_api(Request $request, $id)
    {
        return Post::destroy($id);
    }
}
