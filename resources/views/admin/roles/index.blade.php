<x-admin-master>
    @section('content')
    <h1 class="h3 mb-4 text-gray-800">Roles</h1>
    @section('content')
    @if(session('deleted_message'))
    <div class="alert alert-danger">{{session('deleted_message')}}</div>
    @elseif(session('created_message'))
    <div class="alert alert-success">{{session('created_message')}}</div>
    @endif
    <h1 class="h3 mb-4 text-gray-800">Create</h1>

    <div class="col-sm-3">
    <form method="POST" action="{{route('role.store')}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Role Name" >
            @error('name')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>


        <button  type="submit"  class="btn-primary btn-block">Add</button>
    </form>
    </div>
    <div class="col-sm-9">
        <table class="table table-bordered" id="roleTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Delete</th>

            </tr>
            </thead>
            <tfoot>

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Delete</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($roles as $role)
            <tr>

                <td>{{$role->id}}</td>
                <td>{{$role->name}}</a></td>
                <td>{{$role->slug}}</td>

                <td>
                    <form  method="post" action="{{route('role.destroy',$role->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')

                        <button class="btn badge-danger">Delete</button>

                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

    </div>

    @endsection
    @endsection
</x-admin-master>
