<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{
    //
    protected $fillable = [
        'body',
    ];

    public function index(){

        return view('blog-post');
    }

    public function destroy(Comment $comment){
        $comment->delete();
        \session()->flash('deleted_message',' Comment was Deleted');

        return back();
    }
    public function replyStore(Request $request)
        {
            $reply = new Comment();
            $reply->body = $request->get('comment_body');
            $reply->user()->associate($request->user());
            $reply->parent_id = $request->get('comment_id');
            $post = Post::find($request->get('post_id'));
            $post->comments()->save($reply);

            return back();

        }

    public function store(Request $request)
    {
        \request()->validate([
            'comment_body'=>'required',
        ]);
        $comment = new Comment;
        $comment->body = $request->get('comment_body');
        $comment->user()->associate($request->user());
        $post = Post::find($request->get('post_id'));
        $post->comments()->save($comment);
        return back();
    }
}
