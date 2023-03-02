<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
// use App\Http\Requests\MediaStoreRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{

    public function index_media(Request $request)
    {
        return response()->json(Media::all(), 200);
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
        // Check if the file is present in the request
        // if (!$request->hasFile('image')) {
        //     return response()->json([
        //         'message' => 'Image not found in request',
        //         'status' => 'error',
        //     ], 400);
        // }

        //decode the base64-encoded image data
        $decodedImage = base64_decode($request->input('image'));

        //store the decoded image data in the "decoded_media_images" directory
        $imagePath = 'decoded_media_images/' . time() . '.png';
        Storage::disk('public')->put($imagePath, $decodedImage);

        //create_media
        $media = Media::create(
            [
                'title' => $request->title,
                'image' => $imagePath,
                'newspaper_name' => $request->newspaper_name,
                'newspaper_url' => $request->newspaper_url,
                'newspaper_title' => $request->newspaper_title,
                'newspaper_description' => $request->newspaper_description
            ]
        );
        return response()->json([
            'message' => 'Image Uploaded',
            'status' => 'success',
            'media' => $media
        ], 200);
    }
    public function show_single_media(Request $request, $id)
    {
        return response()->json(Media::findOrFail($id));
    }
    public function show_media(Request $request)
    {
        return response()->json(Media::all());
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
