<x-admin-master>
    @section('content')
    <h1 class="h3 mb-4 text-gray-800">Update</h1>

    <form method="POST" action="{{route('post.update',$post->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="title" >Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title" value="{{$post->title}}">
        </div>
        <div class="form-group">
            <textarea name="body" cols="30" class="form-control" id="body" rows="10" >{{$post->body}}</textarea>
        </div>
        <div>
            <img height="100px" src="{{$post->post_image}}">
        </div>
        <div class="form-group">
            <input type="file" name="post_image" class="form-control-file" id="post_image"  >
        </div>
        <button  type="submit"  class="btn-primary">Update</button>
    </form>
    @endsection
</x-admin-master>
