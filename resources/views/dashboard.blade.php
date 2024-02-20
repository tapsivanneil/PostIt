<x-app-layout>

    <div class="blog-holder">
        @foreach ($blogs as $blog)
            <div class="blog-card">
                <div>{{$blog->blog_title}}</div>
                <div>{{$blog->author->name}}</div>
                <div>{{$blog->blog_post}}</div>
                <div class="blog-card-footer" >
                    @if ($userLiked->contains('blog_id', $blog->id))
                        <form action="{{route('unlikePost', ['id' => $blog->id, 'user_id' => $blog->author->id])}}" method="post">
                            @csrf
                            <button type="submit">Unlike</button>
                        </form>    
                    @else
                        <form action="{{route('likePost', ['id' => $blog->id, 'user_id' => $blog->author->id])}}" method="post">
                            @csrf
                            <button type="submit">Like</button>
                        </form>
                    @endif

                    
                    <div>{{$blog->blog_likes}}</div>
                    <div>{{$blog->updated_at}}</div>
                </div>

                
            </div>
        
        @endforeach
    </div>

    <a href="{{ route('createblog') }}" class="blog-link">Blog</a>

    


   

</x-app-layout>
