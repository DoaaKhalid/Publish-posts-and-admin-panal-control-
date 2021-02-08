<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
class PostController extends Controller
{
    //
    public function show(Post $post,Request $request)
    {
        $comments= Comment::where('commentable_id',$post->id)->get();

        return view('blog-post',compact('post','comments'));
    }
    public function create()
    {
        return view('admin.post.create');
    }
    public function store()
    {
       $input= \request()->validate([
           'title'=>'required|min:8|max:255',
            'post_image'=>'file',
            'body'=>'required'
        ]);
       if(request('image'))
       {
           $input['post_img']=request('post_image')->store('images');

       }

        auth()->user()->posts()->create($input);

       \session()->flash('createdmessage',$input['title'].' was Created');
       return redirect()->route('post.index');
    }
    public function index(){
        $posts=Post::all();

     return view('admin.post.index',['posts'=>$posts]);
    }
    public function edit(Post $post){
        $this->authorize('view',$post);
        return view('admin.post.update',['post'=>$post]);
    }
    public function destroy(Post $post){
    $post->delete();
    Session::flash('message','Post was Deleted');
    return back();
    }
    public function update(Post $post){
        $input= \request()->validate([
            'title'=>'required|min:8|max:255',
            'post_image'=>'file',
            'body'=>'required'
        ]);
        if(request('image'))
        {
            $input['post_img']=request('post_image')->store('images');
            $post->post_image=$input['post_img'];

        }
        $post->title=$input['title'];
        $post->body=$input['body'];
        $this->authorize('update',$post);
        $post->save();

        \session()->flash('updatedmessage','Post Updated');
        return redirect()->route('post.index');
    }


}
