<x-admin-master>
    @section('content')
    <h1 class="h3 mb-4 text-gray-800">View Users</h1>
    @if(Session::has('delete_message'))
    <div class="alert alert-danger">{{Session::get('delete_message')}}</div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Users Table</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive ">
                <table class="table table-bordered" id="userTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>User Name</th>
                        <th>Image</th>
                        <th>Register Date</th>
                        <th>Updated Date</th>
                        <th>Delete</th>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>User Name</th>
                        <th>Image</th>
                        <th>Register Date</th>
                        <th>Updated Date</th>

                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td><a href="{{route('users.profile.show',$user)}}">{{$user->name}}</a></td>

                        <td>{{$user->user_name}}</td>
                        <td>
                            <img width="40px"  src="{{$user->avatar}}">
                        </td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>{{$user->updated_at->diffForHumans()}}</td>
                        <td>
                            <form  method="post" action="{{route('user.destroy',$user->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button class="btn badge-danger" >Delete</button>

                            </form>
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
