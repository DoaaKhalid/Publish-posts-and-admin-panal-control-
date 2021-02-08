<x-home-master>
    @section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3><b>{{ $post->title }}</b></h3>
                        <p>
                            {{ $post->body }}
                        </p>

                        <img class="img-fluid rounded" src="{{$post->post_image}}" alt="">
                        <hr />
                        @if(Auth()->check())
                        <h4>Add comment</h4>

                        <form method="post" action="{{ route('comment.store',$post->id) }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="comment_body" class="form-control {{$errors->has('comment_body')?'is-invalid':''}}" />
                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                @error('comment_body')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-warning" value="Add Comment" />
                            </div>
                        </form>


                        <hr />
                        @endif
                        <h4> Comments</h4>
                        @foreach($comments as $comment)
                        @if($comment->parent_id===null)
                        <div class="media mb-4">
                            <div>
                            <img class="img-profile rounded-circle" width="40px" height="30px" src="{{$comment->user->avatar}}">
                        </div>
                            <div>
                                @if(Auth()->check())
                                &nbsp&nbsp<a href="{{route('users.profile.show', $comment->user)}}">
                                    <strong>{{ $comment->user->name }}</strong>
                                </a>
                               @else
                                <strong> &nbsp&nbsp{{ $comment->user->name }}</strong>

                                @endif

                                <div class="row">

                                    <div class="col-md-8">
                                        &nbsp&nbsp  {{$comment->body}}
                                    </div>
                                    <div class="col-md-4">
                                        <form  method="post" action="{{ route('comment.destroy',$comment->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            @if(Auth()->check())
                                            @if($comment->user->id=== auth()->user()->id ||auth()->user()->userHasRole('Admin'))
                                            <div>
                                                <button class="btn btn-outline-danger ">Delete</button>
                                            </div>
                                            @endif
                                            @endif

                                        </form>
                                    </div>
                                </div>




                                <div class="bg-white py-2 collapse-inner rounded">
                                    @foreach($comments as $comment2)
                                    @if($comment2->parent_id===$comment->id)
                                    <div class="media mb-4">
                                        <div>
                                            <img class="img-profile rounded-circle" width="40px" height="30px" src="{{$comment->user->avatar}}">
                                        </div>
                                        <div>
                                            @if(Auth()->check())
                                            &nbsp&nbsp<a href="{{route('users.profile.show', $comment2->user)}}">
                                                <strong>{{ $comment2->user->name }}</strong>
                                            </a>
                                            @else
                                            <strong> &nbsp&nbsp{{ $comment2->user->name }}</strong>

                                            @endif
                                            <div class="row">

                                                <div class="col-md-8">
                                                    &nbsp&nbsp  {{$comment2->body}}
                                                </div>
                                                <div class="col-md-4">
                                                    <form  method="post" action="{{ route('comment.destroy',$comment2->id) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        @if(Auth()->check())
                                                        @if($comment2->user->id=== auth()->user()->id ||auth()->user()->userHasRole('Admin'))
                                                        <div>
                                                            <button class="btn btn-outline-danger ">Delete</button>
                                                        </div>
                                                        @endif
                                                        @endif

                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    @endif
                                    @endforeach

                                </div>





















                                @if(Auth()->check())




                                <div class="display-comment">

                                    <form method="post" action="{{ route('reply.add') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="comment_body" class="form-control" />
                                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                            <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-warning" value="Reply" />
                                        </div>
                                    </form>
                                </div>
@endif
                            </div>
                        </div>

                        @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Comments Form -->



    @endsection
</x-home-master>


<!-- Single Comment -->
