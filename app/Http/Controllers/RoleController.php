<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    //
    public function index()
    {
        $roles=Role::all();
        return view('admin.roles.index',['roles'=>$roles]);
    }
    public function destroy(Role $role){
        $role->delete();
        \session()->flash('deleted_message',\request('name').' role was Deleted');

        return back();
    }

    public function store()
    {
         \request()->validate([
            'name'=>'required'
        ]);

         Role::create([
             'name'=>\request('name'),
             'slug'=>Str::lower(\request('name'))
         ]);
        \session()->flash('created_message',\request('name').' role was Created');
         return back();
    }
}
