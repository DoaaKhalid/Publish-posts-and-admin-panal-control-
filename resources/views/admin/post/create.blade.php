<x-admin-master>
    @section('content')
    <h1 class="h3 mb-4 text-gray-800">Create</h1>
    <form method="POST" action="{{route('post.store')}}" enctype="multipart/form-data">
       @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title" >
        </div>
        <div class="form-group">
            <textarea name="body" cols="30" class="form-control" id="body" rows="10"></textarea>
        </div>
        <div class="form-group">
            <input type="file" name="post_image" class="form-control-file" id="post_image"  >
        </div>
        <button  type="submit"  class="btn-primary">Add</button>
    </form>
    @endsection
</x-admin-master>
