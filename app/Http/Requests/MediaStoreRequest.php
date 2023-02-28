<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        if(request()->isMethod('post')){
            return [
                'title' => 'required|string|max:258',
                'image' => 'required|image|mims:jpeg,png,jpg,gif,svg|max:2048',
                'news_title' => 'required|string|max:258',
                'news_description' => 'required|text',
            ];
        } else{
            return [
                'title' => 'required|string|max:258',
                'image' => 'required|image|mims:jpeg,png,jpg,gif,svg|max:2048',
                'news_title' => 'required|string|max:258',
                'news_description' => 'required|text',
            ];
        }
    }
    public function messages()
    {
        if(request()->isMethod('post')){
            return [
                'title_required' => 'title is required!',
                'image_required' => 'image is required!',
                'news_title_required' => 'news_title is required!',
                'news_description_required' => 'news_description is required!',
            ];
        } else{
            return [
                'title_required' => 'title is required!',
                'news_title_required' => 'news_title is required!',
                'news_description_required' => 'news_description is required!',
            ];
        }
    }
}
