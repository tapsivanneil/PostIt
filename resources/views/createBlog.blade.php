<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Blog') }}
        </h2>
    </x-slot>

    <div class="blog-holder">
       
    </div>
    
    <div class="blog-create">
        <form action="{{route('createBlog')}}" method="post">
            @csrf
            <input type="text" name="addBlog_title" id="addBlog_title">
            <input type="text" name="addBlog_body" id="addBlog_body">
            <button type="submit" >Upload Blog</button>
        </form>
    </div>

</x-app-layout>
