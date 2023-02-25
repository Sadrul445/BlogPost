<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session()->has('status'))
                        <div style="color:#20a4e1;font-size:18px;font-weight:bold;margin:2rem">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">User Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Author</th>
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Description</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($posts as $post)
                                    <td class="border px-4 py-2">{{ $post->user->name }}</td>
                                    <td class="border px-4 py-2">{{ $post->user->email }}</td>
                                    <td class="border px-4 py-2">{{ $post->author }}</td>
                                    <td class="border px-4 py-2">{{ $post->title }}</td>
                                    <td class="border px-4 py-2">{{ $post->description }}</td>
                                    <td class="border px-4 py-2 mx-4" style="width:15%">
                                        <a href="{{ url('/post/edit', $post->id) }}" class="px-3"
                                            style="background-color:#20a4e1;color:white;margin-right:10px;padding:5px;border-radius:8px">Edit
                                            <a href="{{ url('/post/delete', $post->id) }}" class="px-3"
                                                style="background-color:#dc143c;color:white;margin-right:10px;padding:5px;border-radius:8px">Delete
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
