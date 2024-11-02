<?php

namespace App\Http\Controllers;



use App\Http\Requests\CommentReplyCreateRequest;
use App\Notifications\PostCommentNotification;
use Illuminate\Http\Request;
use App\Http\Requests\CommentCreateRequest;
use App\Models\PostComment;
use App\Models\PostCommentReply;
use App\Models\Posts;
use Illuminate\Support\Facades\Auth;

class PostCommentController extends Controller
{

    public function store(CommentCreateRequest $request){

        $validated = $request->validated(); // validate form request and extract the data for the form
        // data is fetched from the validation

        $comment = PostComment::create([
            ...$validated,
            'user_id'=> Auth::user()->id
        ]);
        $post = Posts::find($request->post_id);
        $post->user->notify(new PostCommentNotification($comment));
        return back()->with('success','New Comment Added');
    }

    // post a new reply
    public function replyTo(CommentReplyCreateRequest $request, Posts $post){
        $validated = $request->validated();
        PostCommentReply::create([
            ...$validated,
            'user_id'=> Auth::user()->id
        ]);
        return back()->with('success', 'You replied to a comment!');
    }
}
