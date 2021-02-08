<x-admin-master>
    @section('content')

    @if(auth()->user()->userHasRole('Admin')||auth()->user()->id==$user->id)

    <div class="col-sm-6">

    <form method="POST" action="{{route('users.profile.update',$user->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @if(session('updated_message'))
        <div class="alert alert-success">{{session('updated_message')}}</div>
        @endif
        <div class="form-group md-4">
            <img  class="img-profile rounded-circle embed-responsive" src="{{asset($user->avatar)}}" alt="">

            <input type="file" name="avatar" id="avatar">
        </div>
        <div class="form-group">
            <label for="name" >Name</label>
            <input type="text"
                   class="form-control {{$errors->has('name')?'is-invalid':''}}"
                   name="name"
                   id="name"
                   value="{{$user->name}}">
            @error('name')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="user_name" >User Name</label>
            <input type="text"
                   class="form-control {{$errors->has('user_name')?'is-invalid':''}}"
                   name="user_name"
                   id="user_name"
                   value="{{$user->user_name}}">
            @error('user_name')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email" >Email</label>
            <input type="text"
                   class="form-control {{$errors->has('email')?'is-invalid':''}}"
                   name="email"
                   id="email"
                   value="{{$user->email}}">
        </div>
        @error('email')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
        <div class="form-group">
            <label for="name" >Password</label>
            <input type="password"
                   class="form-control"
                   name="password"
                   id="password"
        </div>
        @error('password')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
        <div class="form-group">
            <label for="name" >Confirm Password</label>
            <input type="password"
                   class="form-control"
                   name="confirmpassword"
                   id="confirmpassword"
        </div>

        <button  type="submit"  class="btn-primary">Update</button>
    </form>

     </div>


    @else
    <h1> {{$user->name}} Profile</h1>
    <img class="img-profile rounded-circle" height="100px" src="{{asset($user->avatar)}}" alt="">
    <hr>
    <label for="name" >Name : <strong>{{$user->name}}</strong></label>
    <hr>
    <label for="name" >Email : <strong>{{$user->email}}</strong></label>
    <hr>
    <label for="name" >User Name : <strong>{{$user->user_name}}</strong></label>
    <hr>
    <label for="name" >User Role : <strong>{{$role->name}}</strong></label>
    </form>

    @endif
    @if(auth()->user()->userHasRole('Admin'))

    <div class="col-sm-12">
        <table class="table table-bordered" id="userTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Option</th>

                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Attach</th>
                <th>Detach</th>
            </tr>
            </thead>
            <tfoot>

            <tr>
                <th>Option</th>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Attach</th>
                <th>Detach</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($roles as $role)
            <tr>
                <td><input type="checkbox"

                           @foreach($user->roles as $user_role)
                    @if($user_role->slug == $role->slug)
                    checked
                    @endif
                    @endforeach >
                </td>

                <td>{{$role->id}}</td>
                <td><a href="{{route('users.profile.show',$user)}}">{{$role->name}}</a></td>

                <td>{{$role->slug}}</td>
                <td>
                    <form  method="post" action="{{route('user.role.attach',$user)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input name="role" type="hidden" value="{{$role->id}}">
                        <button type="submit" class="btn badge-success"
                                @if($user->roles->contains($role))
                            disabled
                            @endif
                            >Attach</button>

                    </form>
                </td>
                <td>
                    <form  method="post" action="{{route('user.role.detach',$user)}}" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <input name="role" type="hidden" value="{{$role->id}}">

                        <button class="btn badge-danger"
                                @if(!$user->roles->contains($role))
                            disabled
                            @endif
                            >Detach</button>

                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endif
    @endsection
</x-admin-master>
