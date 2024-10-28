<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'comment'
    ];

    // get comments
    public function scopeGetCommentsByPostId($query, $id){
        $query->join('users','users.id','=','post_comments.user_id')
            ->join('posts','posts.id','=','post_comments.post_id')
            ->select([
                'post_comments.*',
                'users.fname',
                'users.lname',
                'users.image_path'
            ])
            ->where('posts.id', $id);

        return $query->paginate(10);
    }
}
