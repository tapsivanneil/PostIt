<x-app-layout>

    <div class="blog-holder">
        @foreach ($blogs as $blog)
            <div class="blog-card">
                <div>{{$blog->blog_title}}</div>
                <div>{{$blog->author->name}}</div>
                <div>{{$blog->blog_post}}</div>
                <div class="blog-card-footer" >
                    <div>Likes: {{$blog->blog_likes}}</div>
                    <div>{{$blog->updated_at}}</div>
                    <div>
                        <form action="{{route('deletePost', $blog->id)}}" method="post">
                            @csrf
                            <button type="submit">Delete</button>
                        </form>
                    </div>

                </div>
            </div>
        
        @endforeach
    </div>

    <a href="{{ route('createblog') }}" class="blog-link">Blog</a>

    


   

</x-app-layout>
