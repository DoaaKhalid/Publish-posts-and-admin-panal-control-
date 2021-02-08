<x-admin-master>
    @section('content')
    <h1 class="h3 mb-4 text-gray-800">View Posts</h1>
    @if(Session::has('message'))
    <div class="alert alert-danger">{{Session::get('message')}}</div>
    @elseif(session('createdmessage'))
    <div class="alert alert-success">{{session('createdmessage')}}</div>
    @elseif(session('updatedmessage'))
    <div class="alert alert-success">{{session('updatedmessage')}}</div>


    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive ">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Owner</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Image</th>
                        <th>Created Date</th>
                        <th>Updated Date</th>
                        <th>Delete</th>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Owner</th>

                        <th>Title</th>
                        <th>Content</th>
                        <th>Image</th>
                        <th>Created Date</th>
                        <th>Updated Date</th>
                        <th>Delete</th>

                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->user->name}}</td>
                        <td><a href="{{route('post.edit',$post->id)}}">{{$post->title}}</a></td>
                        <td>{{$post->body}}</td>
                        <td>
                            <img width="40px"   src="{{asset($post->post_image)}}">
                        </td>
                        <td>{{$post->created_at->diffForHumans()}}</td>
                        <td>{{$post->updated_at->diffForHumans()}}</td>
                        <td>
                            @can('view',$post)
                            <form  method="post" action="{{route('post.destroy',$post->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button class="btn badge-danger" >Delete</button>

                            </form>
                        @endcan
                        </td>

                    </tr>
                     @endforeach
                    </tbody>
                </table>

            </div>
    
        </div>
    </div>


    @endsection

    @section('scripts')
    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
   <!-- <script src="{{asset('js/demo/datatables-demo.js')}}"></script>-->
    @endsection
</x-admin-master>
