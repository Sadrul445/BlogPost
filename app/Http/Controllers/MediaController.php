<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{

    public function show_media(Request $request)
    {
        $medias = Media::all();

        foreach($medias as $media){

            $decodedImage = $media->image;

            $decodedImageData = Storage::disk('public')->get($decodedImage);
            
            $encodedImageData = base64_encode($decodedImageData);

            $media->encoded_image_data = $encodedImageData;
        }
        return response()->json($medias,200);
    }
    public function show_single_media(Request $request,$id){
        $media = Media::find($id);
        $decodedImage = $media->image;
        $decodedImageData = Storage::disk('public')->get($decodedImage);
        $encodedImageData = base64_encode($decodedImageData);
        $media->encoded_image_data = $encodedImageData;
        return response()->json($media,200);
    }
    public function store_media(Request $request)
    {
        //validation
        $request->validate(
            [
                'title' => 'required|string',
                'image' => 'required',
                'newspaper_name' => 'required',
                'newspaper_title' => 'required',
                'newspaper_url' => 'required',
                'newspaper_description' => 'required',
            ]
        );

        //decode the base64-encoded image data 
        $decodedImage = base64_decode($request->input('image'));
        //store the decoded image data in the "decoded_media_images" directory
        $decodedImagePath = 'decoded_image/' . time() . '.png';
        Storage::disk('public')->put($decodedImagePath, $decodedImage);

        //create_media
        $media = Media::create(
            [
                'title' => $request->title,
                'image' => $decodedImagePath, //decode
                'newspaper_name' => $request->newspaper_name,
                'newspaper_url' => $request->newspaper_url,
                'newspaper_title' => $request->newspaper_title,
                'newspaper_description' => $request->newspaper_description
            ]
        );
        
        return response()->json([
                'message' => 'Image Uploaded',
                'status' => 'Success',
                'media' => $media,
        ], 200);
    }

    public function update_media(Request $request, $id)
    {
        $media = Media::findOrFail($id);

        $media->title = $request->title;

        $updated_image_location = public_path("storage\\" . $media->image);
        if ($request->hasFile('new_image')) {
            if (File::exists($updated_image_location)) {
                File::delete($updated_image_location);
            }
            $image = $request->file('new_image')->store('updated_media_images', 'public');
        } else {
            $image = $request->image;
        }

        $media->newspaper_name = $request->newspaper_name;
        $media->newspaper_url = $request->newspaper_url;
        $media->newspaper_description = $request->newspaper_description;
        $media->save();
        return $media;
    }
    public function delete_media(Request $request, $id)
    {
        return Media::destroy($id);
    }
}
