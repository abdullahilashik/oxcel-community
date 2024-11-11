<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentCreateRequest;
use App\Http\Requests\CommentReplyCreateRequest;
use App\Models\PostComment;
use App\Models\PostCommentReply;
use App\Models\Posts;
use App\Notifications\PostCommentNotification;
use Illuminate\Http\Request;

class ApiPostCommentController extends Controller
{
    // get post comments
    public function index(Posts $post){
        $comments = PostComment::GetCommentsByPostId($post->id);
        return $comments;
    }
    public function store(CommentCreateRequest $request){

        $validated = $request->validated(); // validate form request and extract the data for the form
        // data is fetched from the validation

        $comment = PostComment::create([
            ...$validated,
            'user_id'=> $request->user()->id
        ]);
        $post = Posts::find($request->post_id);
        $post->user->notify(new PostCommentNotification($comment));
        return [
            'success'=> true,
            'message' => 'Comment posted successfully',
            'errors' => false
        ];
    }

    public function replyTo(CommentReplyCreateRequest $request, Posts $post){
        $validated = $request->validated();
        PostCommentReply::create([
            ...$validated,
            'user_id'=> $request->user()->id
        ]);
        return [
            'message'=> 'Reply posted',
            'errors'=> false,
        ];
    }
}
