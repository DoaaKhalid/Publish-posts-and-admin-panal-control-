<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //\
    public function index(){
           $users=User::all();
        return view('admin.users.index',['users'=>$users]);
    }
    public function attach(User $user){
        $user->roles()->attach(\request('role'));
        return back();
    }
    public function detach(User $user){
        $user->roles()->detach(\request('role'));
        return back();
    }

    public function animation()
    {
        return view('admin.utilities-animation');
    }
    public function color()
    {
        return view('admin.utilities-color');
    }
    public function border()
    {
        return view('admin.utilities-border');
    }
    public function other()
    {
        return view('admin.utilities-other');
    }
    public function tables()
    {
        return view('admin.tables');
    }
    public function charts()
    {
        return view('admin.charts');
    }


    public function destroy(User $user){
        $user->delete();
        Session::flash('delete_message',$user->name.' was Deleted');
        return back();
    }
    public function show(User $user)
    {
        $role=$user->roles()->first();

        return view('admin.users.profile',['user'=>$user,'roles'=>Role::all(),'role'=>$role]);
    }
    public function update(User $user)
    {
        $input= \request()->validate([
            'user_name'=>['required','string','max:255','alpha_dash','unique:users'],
            'name'=>['required','string','max:255'],
            'email'=>'required|email|max:255|unique:users',
            'avatar'=>['file'],
        ]);
        if(request('avatar'))
        {
            $input['avatar']=request('avatar')->store('Pic');
            $user->avatar=$input['avatar'];
        }
        else{
            $user->avatar = "https://via.placeholder.com/900x300.png/0088aa?text=people+voluptas";
        }

        $user->name=$input['name'];
        $user->user_name=$input['user_name'];
        $user->email=$input['email'];
        $user->save();
        \session()->flash('updated_message','User Updated');
        return back();

    }
}
