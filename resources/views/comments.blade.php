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
                    <div style="display: flex">
                        <form action="{{route('commentBlogStay', $blogs_id->id)}}" method="post">
                            @csrf
                            <input type="text" name="user_comment">
                            <input type="submit" value="Comment">
                        </form>
                    </div>
                    
                    <div>{{$blog->blog_likes}}</div>
                    <div>{{$blog->updated_at}}</div>
                </div>
                
            </div>
        
        @endforeach



        @foreach ($comments as $comment)
            <div class="blog-card">
                <div></div>
                <div></div>
                <div>{{$comment->comment}}
                    @if ($comment->user_id == $user_id->id)
                            <form action="{{route('deleteComment', $comment->id)}}" method="post">
                                @csrf
                                <button type="submit">Delete</button>
                            </form>

                    @endif

                </div>
                <div class="blog-card-footer" >
                </div>
            </div>
        @endforeach



    <a href="{{ route('createblog') }}" class="blog-link">Blog</a>

    


   

</x-app-layout>
