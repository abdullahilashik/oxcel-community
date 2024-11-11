<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCommentReply extends Model
{
    protected $fillable = [
        'comment_id',
        'user_id',
        'comment'
    ];

    /**
     * Define a relationship to get the comment for this reply.
     */
    public function comment()
    {
        return $this->belongsTo(PostComment::class, 'comment_id');
    }

    /**
     * Define a relationship to get the user who made the reply.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeGetRepliesForComment($query, $commentId){

    }

}
