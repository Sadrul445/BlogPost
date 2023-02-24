<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>
 <div class="flex justify-center items-center h-screen">
    <form class="shadow-md rounded px-8 pt-6 pb-8 mb-4 w-3/4" method="POST">
      @csrf
      @method('PUT')
      @if (session()->has('status'))
      <div style="color:#95e7aeb2;font-size:18px;font-weight:bold;margin:2rem">
        {{session('status')}}
        </div>    
      @endif
      <div class="mb-4 px-6 ">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="author">
         Author
        </label>
        <input class="w-3/4 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
        id="author" type="text" name="author" placeholder="author" value="{{$post->author}}">
      </div>
      <div class="mb-4 px-6 ">
        <label class=" block text-gray-700 text-sm font-bold mb-2 " for="title">
         Title
        </label>
        <input class="w-3/4 shadow appearance-none border rounded  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
        id="title" type="text" name="title" placeholder="title"  value="{{$post->title}}">
      </div>
      <div class="mb-4 px-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
        Description
        </label>
        <textarea class="w-3/4 shadow appearance-none border rounded  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
         id="description" type="text" name="description" placeholder="description">{{$post->description}}</textarea>
      </div>
      <div class="flex items-center justify-between" >
        <input type="submit" style="background-color: green; color:white; margin-left:1.7rem ; margin-bottom:1rem" 
        class="shadow bg-green-500 hover:bg-green-400 focus:shadow-outline focus:outline-none text-black font-bold py-2 px-4 rounded" value="Update">
      </div>
     
    </form>
  
  </div>



</x-app-layout>
